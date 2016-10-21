<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;
use sispes\Http\Requests;
use sispes\User;
use sispes\Des;
use sispes\Ciclo;
use Auth;
use DB;


class AdminController extends Controller
{
    public function index(Request $request){   

        $ciclo = Ciclo::where('activo','=','1')->get();
        $request->session()->put('id_ciclo',$ciclo->first()->id);

        $u      = Auth::user();
        $rol 	= explode(",",$u->rol);
        $plantD = explode(",",$u->plantD);
    	$plantA = $u->plantA;
    	if(count($rol)>1||$rol[0] == 1){
            $request->session()->put('plant',$plantA);
    		return view('admin.home',compact('plantA'));
    	}elseif($rol[0] == 0){
    		return view('root.ciclo_seleccionar');
    	}else{
    		if(count($plantD)>1){                
                $des = Des::select('plant','nomplant')->whereIn("plant",$plantD)->get();                
                return view('docente.plantel_seleccionar',compact('des'));
    		}else{
                $request->session()->put('plant',$plantD[0]);
    			return view('docente.home',compact('plantD'));
    		}
    	}
    }
}
