<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Incomes;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    //


    public function index()

    {
        // El toString sirve para que solo quede almacenado el formato "AAAA-MM-DD" sin la hora
        $currentDate = Carbon::now()->toDateString();

        // Toda la suma de los gastos:
        $totalExpenses = Expenses::where('user_id', Auth::user()->id)->sum('price');

        // Toda la suma de los gastos DE HOY:
        $currentExpenses = Expenses::where('user_id', Auth::user()->id)->whereDate('date', $currentDate)->sum('price');

        // Toda la suma de los ingresos:
        $totalIncomes = Incomes::where('user_id', Auth::user()->id)->sum('amount');

        // El dinero disponible (Ingresos - gastos = Dinero disponible)
        $currentMoney = $totalIncomes - $totalExpenses;

        // Total de dinero gastado en el dia actual:
        $shoppingToday = Expenses::where('user_id', Auth::user()->id)->whereDate('date', $currentDate)->get();


        // Convertimos las anteriores variables a COP:
        $currentMoney_COP = number_format($currentMoney, 0, ',', ',');
        $currentExpenses_COP = number_format($currentExpenses, 0, ',', ',');





        return view('Expenses.home', ['currentMoney' => $currentMoney_COP, 'currentExpenses' => $currentExpenses_COP,  'shoppingToday' => $shoppingToday]);
    }


    public function store(Request $request) {


        $request->validate([

            'name' => 'required',
            'price' => 'required'
        ]);

        $numeroConComa = $request->price;
        $numeroSinComa = str_replace(',', '', $numeroConComa);

        $purshase = new Expenses();

        $purshase->name = $request->name;
        $purshase->price = $numeroSinComa;                
        $purshase->date = Carbon::now();
        $purshase->user_id = $request->user_id;

        $purshase->save();      

        return redirect()->route('home.index')->with('message', 'Compra añadida!');                

    }


    
}
