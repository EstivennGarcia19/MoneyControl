<?php

namespace App\Http\Controllers;

use App\Models\Days;
use App\Models\Expenses;
use App\Models\History;
use App\Models\StalkerIncomes;
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
        
        
        // $year = Carbon::now()->year;                   
        // $months  = DB::table('days')            
        //     ->whereYear('id', $year)
        //     ->selectRaw('MONTH(id) AS month, YEAR(id) as year, MIN(id) as date, SUM(total) AS total')
        //     ->groupByRaw('YEAR(id), MONTH(id)')->orderByRaw('MONTH(id) DESC')   
        //     ->get();


        // La variable months guardara la consuta en la cual se pide el total, la fecha normal y la fecha(solo mes)
        $months = DB::table('expenses')
        ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(price) as total'),  DB::raw('MAX(date) as date'))
        ->where('user_id', Auth::user()->id)
        ->groupBy(DB::raw('MONTH(date)'), 'user_id')
        ->get();   
        
        // dd($months);
        
        
        
        return view('History.homeHistory', ['collection'=>$months]);
    }
    
    public function incomes()
    {
        $thisIncomes = StalkerIncomes::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('History.incomesHistory', ['thisIncomes' => $thisIncomes]);
    }
    
    


    public function daysExpenses($id, $date) {

        $year = Carbon::now()->year; 
        $date_tittle = Expenses::select('date')
                ->distinct()
                ->where('date', '=', $date)
                ->get();

        // $date_tittle = Expenses::whereDate('date', $date)->select('date')->get();
        $days = Days::where('user_id', Auth::user()->id)->whereYear('date', $year)->whereMonth('date', $id)->selectRaw('MONTH(date) as month, date AS date, total AS total')->get();


        return view("History.daysHistory", ['collection'=>$days, 'date_tittle'=>$date_tittle]);

    }

    public function detailDay($id) {

        $detail_days = Expenses::whereDate('date', $id)->where('user_id', Auth::user()->id)->get();
        $date_tittle = Expenses::whereDate('date', $id)->select('date')->get();
        


        return view("History.detailDayHistory", ['date_tittle'=>$date_tittle,'collection'=>$detail_days]);        
        // return "Hola macaco = ".$detail_days;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        

        $months = DB::table('expenses')
        ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(price) as total'),  DB::raw('MAX(date) as date'))
        ->where('user_id', Auth::user()->id)
        ->groupBy(DB::raw('MONTH(date)'), 'user_id')
        ->get();            

        return view('History.homeHistory', ['collection'=>$months]);
    }




    public function forgottenDay() {

        return view('History.addDayForgottenHistory');
    }

    public function addforgottenDay(Request $request) {

        $numeroConComa = $request->price;
        $numeroSinComa = str_replace(',', '', $numeroConComa);

        $new_day = new Expenses();

        $new_day->name = $request->name;
        $new_day->price = $numeroSinComa;
        $new_day->date = $request->date;
        $new_day->user_id = $request->user_id;        
        $new_day->save(); 

        $detail_days = Expenses::whereDate('date', $new_day->date)->get();
        $date_tittle = Expenses::whereDate('date', $new_day->date)->select('date')->get();
        


        return view("History.detailDayHistory", ['date_tittle'=>$date_tittle,'collection'=>$detail_days]);        
        // return "Hola macaco = ".$detail_days;
        
    }

}
