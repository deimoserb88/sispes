<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
	protected $table = 'programa';
    public function asignatura(){
    	return $this->hasMany('asignatura','plan','plan');
    }
}
