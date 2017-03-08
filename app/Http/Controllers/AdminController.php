<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;
use sispes\Http\Requests;
use sispes\User;
use sispes\Des;
use sispes\Ciclo;
use sispes\Periodo;
use Auth;
use DB;


class AdminController extends Controller
{
    /**
     * [index description]
     * @param  Request $request [para manejar las variables de sesion]
     * @param  [type]  $r       [rol, para cuando el res cambia de rol a docente]     
     */
    public function index(Request $request,$r = null){   

        $ciclo = Ciclo::where('activo','=','1')->get();        
        $request->session()->put('id_ciclo',$ciclo->first()->id);
        $cicloNombre = Ciclo::select('desc')->where('id','=',$ciclo->first()->id)->get();

        $u = Auth::user();
        if(!is_null($r)){
            $rol[0] = $r;
        }else{
            $rol = explode(",",$u->rol);
        }
        $plantD = explode(",",$u->plantD);
    	$plantA = $u->plantA;
    	if(count($rol)>1||$rol[0] == 1){
            $request->session()->put('plant',$plantA);
            $request->session()->put('rol','1');            
    		return view('admin.home',compact('plantA'));
    	}elseif($rol[0] == 0){
            $ciclos = Ciclo::all()->sortBy('cde');
            $request->session()->put('rol','0');
    		return view('root.ciclo_seleccionar',compact('ciclos'));
    	}else{
            $request->session()->put('rol','2');
            $periodo = new Periodo;

            $periodos = $periodo->with('ciclo')
                            ->where('id_ciclo','=',$ciclo)
                            ->where('plant','=',$plant)
                            ->orderBy('tipo')
                            ->get();
    		if(count($plantD)>1){                
                $des = Des::select('plant','nomplant')->whereIn("plant",$plantD)->get();                
                return view('docente.plantel_seleccionar',compact('des','cicloNombre'));
    		}else{            
                $request->session()->put('plant',$plantD[0]);
    			return view('docente.home',compact('plantD','cicloNombre','periodo'));
    		}
    	}
    }

    
    /**
     * [matDoc Modulo para regiustrar las asignaciones de docentes y materias]
     * @return [null] []
     */
    public function matDoc(){
        return view('admin.registro_materia_docente');
    }

    public function saveMatDoc(Request $request){
        $texto = $request->datos;
        $datos = preg_split("/((\r?\n)|(\r\n?))/",$texto);
        foreach ($datos as $key => $value) {
            $tabladatos[$key] = $value;
        }
        return view('admin.matdoclist',compact('tabladatos'));
    }


    public function getWebService(Request $request){
        $url = 'http://sistemas2.ucol.mx/plandocente/practicas/';
        $json = file_get_contents($url);
        $datos = json_decode($json,true);        
        return view('admin.webservicetest',compact('datos'));
    }
}
