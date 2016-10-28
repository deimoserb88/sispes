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
        $periodo = new Periodo;
    	$periodos = $periodo->with('ciclo')->where('id_ciclo','=',$ciclo)->where('plant','=',$plant->first()->plant)->get();
    	return view('docente.home',compact('periodos'));
    }

    public function selPlantel($plantel,Request $request){
    	$ciclo = $request->session()->get('id_ciclo');
        $request->session()->put('plant',$plantel);
        
        $periodo = new Periodo;
        $pcp = $periodo->where('plant','=',$plantel)->count();//plantel/ciclo/periodo para contar si hay periodos especificos para el plantel
        if($pcp>0){
            $plant = $plantel;
        }else{
            $plant = '0000';
        }
        
        $periodos = $periodo->with('ciclo')->where('id_ciclo','=',$ciclo)->where('plant','=',$plant)->get();
    	return view('docente.home',compact('plantel','periodos'));
    }

    public function cambiarPlantel($plantD,Request $request){
        $des = Des::select('plant','nomplant')->whereIn("plant",explode(",",$plantD))->get();                
        return view('docente.plantel_seleccionar',compact('des'));
    }
}
