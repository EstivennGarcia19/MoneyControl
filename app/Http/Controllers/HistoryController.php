<?php

namespace App\Http\Controllers;

use App\Models\Days;
use App\Models\Expenses;
use App\Models\History;
use App\Models\Incomes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // La variable months guardara la consuta en la cual se pide el total, la fecha normal y la fecha(solo mes)
        $months = DB::table('expenses')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(price) as total'),  DB::raw('MAX(date) as date'))
            ->where('user_id', Auth::user()->id)
            ->groupBy(DB::raw('MONTH(date)'), 'user_id')
            ->get();


        return view('History.homeHistory', ['collection' => $months]);
    }


    public function incomes()
    {
        $incomes = Incomes::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('History.incomesHistory', compact('incomes'));
    }




    public function daysExpenses($id, $date)
    {

        $year = Carbon::now()->year;
        $date_tittle = Expenses::select('date')
            ->distinct()
            ->where('date', '=', $date)
            ->get();


        // $date_tittle = Expenses::whereDate('date', $date)->select('date')->get();
        $days = Days::where('user_id', Auth::user()->id)->whereYear('date', $year)->whereMonth('date', $id)->selectRaw('MONTH(date) as month, date AS date, total AS total')->orderBy('id', 'asc')->get();


        return view("History.daysHistory", ['collection' => $days, 'date_tittle' => $date_tittle]);
    }

    public function detailDay($day)
    {


        $detail_days = Expenses::whereDate('date', $day)->where('user_id', Auth::user()->id)->get();
        $date_tittle = Expenses::whereDate('date', $day)->select('date')->get();

        return view("History.detailDayHistory", ['date_tittle' => $date_tittle, 'detail_days' => $detail_days]);
    }


    public function store(Request $request)
    {

        $numeroConComa = $request->price;
        $numeroSinComa = str_replace(',', '', $numeroConComa);

        $purshase = new Expenses();

        $purshase->name = $request->name;
        $purshase->price = $numeroSinComa;
        $purshase->date = $request->date;
        $purshase->user_id = $request->user_id;
        $purshase->save();  

        return redirect()->back();
    }




    public function forgottenDay()
    {

        return view('History.addDayForgottenHistory');
    }

    public function addforgottenDay(Request $request)
    {

        $numeroConComa = $request->price;
        $numeroSinComa = str_replace(',', '', $numeroConComa);

        $new_day = new Expenses();

        $new_day->name = $request->name;
        $new_day->price = $numeroSinComa;
        $new_day->date = $request->date;
        $new_day->user_id = $request->user_id;
        $new_day->save();
        
        return redirect()->route("histoty.index");

    }
}
