<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;

use sispes\Http\Requests;

use sispes\Des;

use sispes\Periodo;

use sispes\Ciclo;

class DocenteController extends Controller
{

    public function index(Request $request){

    	$ciclo = $request->session()->get('id_ciclo');

        $cicloNombre = Ciclo::select('desc')->where('id','=',$ciclo)->get();

    	$plant = $request->session()->get('plant');
        $periodo = new Periodo;

    	$periodos = $periodo->with('ciclo')
                            ->where('id_ciclo','=',$ciclo)
                            ->where('plant','=',$plant)
                            ->orderBy('tipo')
                            ->get();
    	return view('docente.home',compact('periodos','cicloNombre'));
    }

    public function selPlantel($plantel,Request $request){
    	$ciclo = $request->session()->get('id_ciclo');

        $cicloNombre = Ciclo::select('desc')->where('id','=',$ciclo)->get();

        $request->session()->put('plant',$plantel);
        
        $periodo = new Periodo;
        $pcp = $periodo->where('plant','=',$plantel)->count();//plantel/ciclo/periodo para contar si hay periodos especificos para el plantel
        if($pcp>0){
            $plant = $plantel;
        }else{
            $plant = '0000';
        }
        
        $periodos = $periodo->with('ciclo')
                            ->where('id_ciclo','=',$ciclo)
                            ->where('plant','=',$plant)
                            ->orderBy('tipo')
                            ->get();
    	return view('docente.home',compact('plantel','periodos','cicloNombre'));
    }

    public function cambiarPlantel($plantD,Request $request){
        $ciclo = $request->session()->get('id_ciclo');
        $cicloNombre = Ciclo::select('desc')->where('id','=',$ciclo)->get();        
        $des = Des::select('plant','nomplant')->whereIn("plant",explode(",",$plantD))->get();                
        return view('docente.plantel_seleccionar',compact('des','cicloNombre'));
    }


}
