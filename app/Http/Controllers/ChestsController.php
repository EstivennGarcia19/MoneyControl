<?php

namespace App\Http\Controllers;

use App\Models\Chests;
use App\Models\StalkerChest;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;



class ChestsController extends Controller
{
  
    public function index()
    {

        $myChests = Chests::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();        
        
        return view('Chests.index_chests', compact('myChests'));
    }

  
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
        // El numero es enviado con decimales, aca se los quitamos (19,000 = 19000)
        $numeroSinComa = str_replace(',', '', $request->amount);     
        
        // Si no insrta ningun valor o es 0 no insertamos nada
        if ($numeroSinComa == 0 || $numeroSinComa == null) {

            return "Perro hpta"; 

        } else {

            // Cuando se crea el cofre, queda con todos los campos vacios, aqui actualizamo esos campos vacios a los enviados por el formulario
            $info_chest->name = $request->name;   
            $info_chest->amount += $numeroSinComa;      
            $info_chest->date = $request->date; 
    
            $info_chest->save(); 

            // En la tabla de StalkerChest, se llevaran los registros de Ingreso y egreso del cofre
            // Asi que aqui se inserta lo que se Agrego, cuanto, cuando y que en cofre
            $stalker =  new StalkerChest;        

            $stalker->action_per = 'Añadido';
            $stalker->amount = $numeroSinComa;
            $stalker->chest_id = $info_chest->id;
            $stalker->created_at = Carbon::now();
            $stalker->updated_at = Carbon::now();
            $stalker->save();            
                                                
            return redirect()->back();
        }
        
    }

    public function remove_amount(Request $request, Chests $info_chest)
    {  
        // El numero es enviado con decimales, aca se los quitamos (19,000 = 19000)
        $numeroSinComa = str_replace(',', '', $request->amount);   
                
        // Cuando se crea el cofre, queda con todos los campos
        //  vacios, aqui actualizamo esos campos vacios a los enviados por el formulario
        $info_chest->name = $request->name;   
        $info_chest->amount -= $numeroSinComa;   
        $info_chest->date = $request->date; 

        $info_chest->save(); 
        
         // En la tabla de StalkerChest, se llevaran los registros de Ingreso y egreso del cofre
        // Asi que aqui se inserta que se Retiro, cuanto, cuando y que cofre
        $stalker =  new StalkerChest;        

        $stalker->action_per = 'Retirado';
        $stalker->amount = $numeroSinComa;
        $stalker->chest_id = $info_chest->id;
        $stalker->created_at = Carbon::now();
        $stalker->updated_at = Carbon::now();
        $stalker->save();
      
        return redirect()->back();
        
    }

   
    public function destroy(Chests $chest)
    {        
        $chest->delete();
        return redirect()->route('chests.index');
    }


    public function changeColor($chest, $color) {

        $chest = Chests::find($chest);

        $chest->color = '#'.$color;
        $chest->save();                

        return redirect()->back();
        
    }
}
