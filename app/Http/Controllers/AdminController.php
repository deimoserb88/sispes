<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;
use sispes\Http\Requests;
use sispes\User;
use sispes\Des;
use sispes\Ciclo;
use sispes\Periodo;
use sispes\Asignatura;
use sispes\Programa;
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
                            ->where('id_ciclo','=',$ciclo->first()->id)
                            ->where('plant','=',$plantD[0])
                            ->orderBy('tipo')
                            ->get();
            if(count($periodos->toArray()) == 0){
                $periodos = $periodo->with('ciclo')
                                ->where('id_ciclo','=',$ciclo->first()->id)
                                ->where('plant','=','0000')
                                ->orderBy('tipo')
                                ->get();                
            }
    		if(count($plantD)>1){                
                $des = Des::select('plant','nomplant')->whereIn("plant",$plantD)->get();                
                return view('docente.plantel_seleccionar',compact('des','cicloNombre'));
    		}else{            
                $request->session()->put('plant',$plantD[0]);
    			return view('docente.home',compact('plantD','cicloNombre','periodos'));
    		}
    	}
    }

    /**
     * [listaGrupos description]
     * @return [type] [description]
     */
    public function listaGrupos(Request $request){
        $u = Auth::user();
        $plantA = $u->plantA;
        $grupos = Grupo::all();
        return view('admin.grupo_listar',compact('grupos','plantA'));
    }


    /**
     * [matDoc Modulo para registrar las asignaciones de docentes y materias]
     * @return [null] []
     */
    public function matDoc(){
        return view('admin.registro_materia_docente');
    }

    public function saveMatDoc(Request $request){
        $texto = $request->datos;
        $datos = preg_split("/((\r?\n)|(\r\n?))/",$texto);
        $erroresD = $erroresM = [];
        $id_ciclo = $request->session()->get('id_ciclo');

        foreach($datos as $lineadatos){
            $te = false; //tiene error
            $registro = explode(',',substr($lineadatos,0,strrpos($lineadatos,',')));
            //print_r($registro);echo "<br>";
            if((int)$registro[0]>0){
               list($i,$materia,$numtrab,$nom,$sem,$gpo,$plan) = $registro; 
               //echo $i." - ".$materia."<br>";
            }else{
                continue;
            }

            /**
             * (1) Se verifica si el docente existe, si no se
             * de de alta, despues se reserva su id
             */
            

            if(!empty($numtrab)){                            
                $doc = User::firstOrNew(['login'=>$numtrab]);                                        
                if(is_null($doc->id)){
                    $doc->login     = $numtrab;
                    $doc->name      = $nom;
                    $doc->plantD    = $request->session()->get('plant');//quien hace esto es responsable del pantel donde se esta dando de alta al docente
                    $doc->rol       = '2'; //2 = docente 
                    $doc->password  = bcrypt($numtrab);//posteriormente se le permitirá que cambi su contrasena, en su primer inicio de sesion
                }else{
                    //si el docente ya está registrado, agregamos el plantel de trabajo actual, ver addPlantelDocente en commfunc.php
                    $doc->plantD    = addPlantelDocente($doc->plantD,$request->session()->get('plant'));
                }
                $doc->save();
                
            }elseif(empty($numtrab)){
                $erroresD[] = ["Error de docente"=>[empty($numtrab)?"No tiene  nombre":"",empty($nom)?"no tiene número de trabajador":""]];
                $te = true;
            }

            /**
             * (2) se valida si la asignatura ya existe (por nombre!), si no, 
             * se da de alta; despues se reserva su id
             */
            
            if(!$te && !empty($materia) && !empty($sem) && !empty($gpo)){
                
                $prog = Programa::where('plan','=',$plan)->first();
                if(!empty($prog)){
                    $mat = new Asignatura;
                    $mat->usar($request->session()->get('plant'));
                    $mat->firstOrNew(['asignatura'=>$materia,'gpo'=>$gpo,'sem'=>$sem]);
                    echo "->".$materia." - " .$gpo. " - ".$sem."<br>";
                    if(is_null($mat->id)){
                        $mat->plan = $plan;
                        $mat->gpo = $gpo;
                        $mat->sem = $sem;
                        $mat->asignatura = $materia;
                        //$mat->save();
                        //echo "materia registrada: ".$mat->id. " - " .$mat->asignatura."<br>";
                    }
                }elseif(!in_array('Programa no encontrado: '.$plan,array_column($erroresM,'Error de programa'))){                        
                    $erroresM[] = ['Error de programa'=>'Programa no encontrado: '.$plan];
                    $te = true;                    
                }
            }
            
        }


        return view('admin.matdoclist',compact('datos'));
        //}
    }


    public function getWebService(Request $request){
        $url = 'http://sistemas2.ucol.mx/plandocente/practicas/';
        $json = file_get_contents($url);
        $datos = json_decode($json,true);        
        return view('admin.webservicetest',compact('datos'));
    }
}
