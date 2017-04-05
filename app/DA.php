<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class DA extends Model
{
    protected $table = '';

    public function usar($plt){
    	$this->table = 'da'.$plt;
    }

    protected $fillable = [
        'id_asigna','id_docente','id_ciclo','activo',
    ];

    public function User(){
    	return $this->belongsTo('sispes\User','id_docente');
    }

    public function Ciclo(){
    	return $this->belongsTo('sispes\Ciclo','id_ciclo');
    }

    public function Asignatura(){
    	return $this->belongsTo('sispes\Asignatura','id_asigna');
    }

}
