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
use sispes\DA;
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
        $ciclo_trabajo = $ciclo->first()->id;       
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
    		return view('root.ciclo_seleccionar',compact('ciclos','ciclo_trabajo'));
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
        $erroresD = $erroresM = $MD = [];
        $id_ciclo = $request->session()->get('id_ciclo');
        $ciclo = Ciclo::select('desc')->where('id','=',$id_ciclo)->get();
        //$ciclo = sispes\Ciclo::select('desc')->where('id','=','13')->get();

        foreach($datos as $lineadatos){
            $te = false; //te => Tiene Error
            $registro = explode(',',substr($lineadatos,0,strrpos($lineadatos,',')));

            /**
             * Si la linea de datos provenientes de la exportacion de sicecu a csv
             * no comienza con un valor numerico entero, es por que se trata de una
             * linea d eencabezados u otros datos, debe ser ignorado.
             */

            if((int)$registro[0]>0){
               list($i,$materia,$numtrab,$nom,$sem,$gpo,$plan) = $registro;                
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
                    //si el docente ya esta registrado, agregamos el plantel de trabajo actual, ver addPlantelDocente en commfunc.php
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
                
                /**
                 * se descartan por defecto las materias de actividades culturales y deporticas, 
                 * servicio socila, inglés, seminarios y electivas, usanod la función matDesc
                 * en commfunc.php
                 */                

                if(!empty($prog) && !matDesc($materia)){
                    $mat = new Asignatura;
                    $mat->usar($request->session()->get('plant'));
                    $t = $mat->where('asignatura','=',$materia)->where('gpo','=',$gpo)->where('sem','=',$sem)->first();               
                    if(is_null($t)){
                        $mat->plan = $plan;
                        $mat->gpo = $gpo;
                        $mat->sem = $sem;
                        $mat->asignatura = $materia;
                        $mat->save();                        
                    }else{
                        $mat->id = $t->id;
                    }
                }elseif(!in_array('Programa no encontrado: '.$plan,array_column($erroresM,'Error de programa'))){                        
                    $erroresM[] = ['Error de programa'=>'Programa no encontrado: '.$plan];
                    $te = true;
                }else{
                    $te = true;
                }
            }

            /**
             * (3) si no hay errores, (i.e. $te = false), se procede a guardar el regostro de relacion
             * materia docente para el ciclo en curso (ciclo de trabajo)
             */
            
            if(!$te){
                $da = new DA;
                $da->usar($request->session()->get('plant'));                                
                $t = $da->where('id_asigna','=',$mat->id)->where('id_docente','=',$doc->id)->where('id_ciclo','=',$id_ciclo)->first();
                if(is_null($t)){                 
                    $da->id_asigna = $mat->id;
                    $da->id_docente = $doc->id;
                    $da->id_ciclo = $id_ciclo;
                    $da->save();
                }else{
                    $da->id = $t->id;
                }
            }

            /**
             * construimos una array para envar la lista a la vista de seleccion
             * de las materias que si tiene prácticas
             */
            if(!$te){
                $MD[] = ["id"=>$da->id,"mat"=>$materia,"doc"=>$nom,'gpo'=>$sem.$gpo,'plan'=>$plan];
            }

            
        }        

        return view('admin.matdoclist',compact('ciclo','MD'));
        
    }

    public function materiasAsignadas(Request $request){
        $plant = $request->session()->get('plant');
        $id_ciclo = $request->session()->get('id_ciclo');
        $ciclo = Ciclo::select('desc')->where('id','=',$id_ciclo)->get();
        $mat = new Asignatura;
        $mat->usar($plant);  
        $da = new DA;
        $da->usar($plant);                                
              
        $MD = $da->select(DB::raw('da'.$plant.'.id,a'.$plant.'.asignatura as mat,users.name as doc,concat(a'.$plant.'.sem,a'.$plant.'.gpo) as gpo,a'.$plant.'.plan'))
                    ->leftJoin('a'.$plant,'da'.$plant.'.id_asigna','=','a'.$plant.'.id')
                    ->leftJoin('users','da'.$plant.'.id_docente','=','users.id')
                    ->get()->toArray();

        return view('admin.matdoclist',compact('ciclo','MD'));
    }


    public function materiasPracticas(Request $request){
        $siPracticas = $request->toArray()['si'];

        $da = new DA;
        $da->usar($request->session()->get('plant'));

        $r = $da->whereNotIn('id',$siPracticas)->get(['id']);

        foreach($r as $dato){
            $da->where('id', '=',$dato->id)->delete();
        }
        
        return redirect()->action('AdminController@materiasAsignadas');
    }

    public function getWebService(Request $request){
        $url = 'http://sistemas2.ucol.mx/plandocente/practicas/';
        $json = file_get_contents($url);
        $datos = json_decode($json,true);        
        return view('admin.webservicetest',compact('datos'));
    }



    public function listadoAsignaturas(Request $request,$plan = "%%"){
        $asignatura = new Asignatura;
        $asignatura->usar($request->session()->get('plant'));

        $planes = $asignatura->select('plan')->distinct('plan')->get()->toArray();

        $progs = Programa::select('plan','programa')->whereIn('plan',array_flatten($planes))->distinct('programa')->get(['id','programa']);
        $p = [];
        foreach($progs as $v){
            $p[$v['plan']] = $v['programa'];
        }        
        $a = $asignatura->where('plan','like',$plan)->get();
        $pln = $plan;
        return view('admin.asignaturas_listar',compact('a','p','pln'));

    }
}
