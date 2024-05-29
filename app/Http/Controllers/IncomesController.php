<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use Carbon\Carbon;
use Illuminate\Http\Request;



class IncomesController extends Controller
{


    public function store(Request $request) {

        // Se envia el valor con comas (19,900) aqui le quitamos esas comas 19900
        $numeroConComa = $request->amount;
        $numeroSinComa = str_replace(',', '', $numeroConComa);

        $income = new Incomes();

        $income->amount = $numeroSinComa;
        $income->date = Carbon::now();
        $income->user_id = $request->user_id;
        $income->save();   

        return redirect()->route('home.index');
    }
    
}
