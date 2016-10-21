<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;

use sispes\Http\Requests;

use sispes\Des;

use sispes\Periodo;

class DocenteController extends Controller
{
    public function index(Request $request){

    	$ciclo = $request->session()->get('id_ciclo');
    	$plant = $request->session()->get('plant');
    	$periodos = Periodo::where('id_ciclo','=',$ciclo->first()->id)
		    				->where('plant','=',$plant->first()->plant)
		    				->get();
    	return view('docente.home',compact('periodos'));
    }

    public function selPlantel($plantel,Request $request){
    	$request->session()->put('plant',$plantel);
    	return view('docente.home',compact('plantel'));
    }

    public function cambiarPlantel($plantD,Request $request){
        $des = Des::select('plant','nomplant')->whereIn("plant",explode(",",$plantD))->get();                
        return view('docente.plantel_seleccionar',compact('des'));
    }
}
