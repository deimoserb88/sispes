<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;
use sispes\Http\Requests;
use sispes\Ciclo;
use DB;

class RootController extends Controller
{
    public function cicloFijar(Request $datos){
    	$ciclo = $datos->ciclo;
    	$ca = $datos->ciclo_activo;
    		
    	$datos->session()->put('id_ciclo',$ciclo);

    	if($ca == 1){
    		Ciclo::where('activo',1)->update(['activo'=>0]);
    		Ciclo::where('id',$ciclo)->update(['activo'=>1]);
    	}

    	return view('root.home');
    	
    }

    public function cicloSeleccionar(){
        $ciclos = Ciclo::all()->sortBy('cde');        
		return view('root.ciclo_seleccionar',compact('ciclos'));    	
    }
}
 