<?php

namespace App\Http\Controllers;

use App\Models\Chests;
use App\Models\StalkerChest;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class ChestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $myChests = Chests::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();        
        
        return view('Chests.index_chests', compact('myChests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)   
    {        
        // Color random para los cofres 
        // $colors = ['#ff696b',"#7b55ff","#ff8e60","#2bc2ff","#5b65fe","#96da45"];
        $colors = ['#ff4b59', '#1896fe', '#704df9', '#ff5d2a', '#2bc2ff', '#000000']; 
        // $colors = ["#ffd3e6", "#b3d1ff", "#b2f1d8", "#fff3b0", "#e6ccff"];
        // $colors = ["#FF6F61", "#40E0D0", "#FFD700", "#7DF9FF", "#BFFF00"];

        $randomColor = $colors[array_rand($colors)];

        Chests::firstOrCreate(
            ['name'=>$request->name], //Mira si ya existe un cofre con el mismo nombre
            [
                'date'=>Carbon::now(),
                'color'=>$randomColor,
                'user_id'=>$request->user_id
            ]
        );
        

        


        return redirect()->route('chests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chests  $chests
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $info_chest = Chests::find($id); 
        $stalker = StalkerChest::where('chest_id', $id)->orderBy('created_at', 'desc')->get();          
        
        return view('Chests.chest', ['info_chest'=>$info_chest, 'stalker'=>$stalker]);
        
    }


   

  
    public function add_amount(Request $request, Chests $info_chest)
    {  
        $numeroConComa = $request->amount;
        $numeroSinComa = str_replace(',', '', $numeroConComa);     
                
        
        $info_chest->name = $request->name;   
        $info_chest->amount += $numeroSinComa;      
        $info_chest->date = $request->date; 

        $info_chest->save(); 
        
        return redirect()->route('chests.index');
        
    }

    public function remove_amount(Request $request, Chests $info_chest)
    {  
        
        $numeroConComa = $request->amount;
        $numeroSinComa = str_replace(',', '', $numeroConComa);
                

        $info_chest->name = $request->name;   
        $info_chest->amount -= $numeroSinComa;   
        $info_chest->date = $request->date; 

        $info_chest->save(); 
        
        return redirect()->route('chests.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chests  $chests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chests $chest)
    {
        //
        $chest->delete();

        return redirect()->route('chests.index');
    }


    public function applyColor($color)
    {
        // Lógica para manejar el color seleccionado
        return view('color-applied', ['color' => $color]);
    }
}
