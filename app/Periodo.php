<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_ciclo','plant', 'tipo', 'pde','pa','activo','created_at','updated_at',
    ];    

    public function ciclo(){
    	return $this->belongsTo('sispes\Ciclo','id_ciclo');
    }

    private static $clavesPeriodos = [0=>'Programación de prácticas',
                              1=>'Primera parcial',
                              2=>'Segunda parcial',
                              3=>'Tercera parcial',
                              4=>'Cuarta parcial',
                              5=>'Quinta parcial'];
                              
    public static function clavesPeriodos($cp){
        return self::$clavesPeriodos[$cp];
    }


    private static $meses = [1=>['Ene','Enero'],
                                ['Feb','Febrero'],
                                ['Mar','Marzo'],
                                ['Abr','Abril'],
                                ['May','Mayo'],
                                ['Jun','Junio'],
                                ['Jul','Julio'],
                                ['Ago','Agosto'],
                                ['Sep','Septiembre'],
                                ['Oct','Octubre'],
                                ['Nov','Noviembre'],
                                ['Dic','Diciembre'],
                                ];
    public static function mes($m,$t=0){
        return self::$meses[$m][$t];
    }


}
