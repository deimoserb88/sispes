<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = '';

    public function usar($plt){
    	$this->table = 'a'.$plt;
    }

    public function getTabla(){
    	return $this->table;
    }

    public function Programa(){
    	return $this->belongsTo('sispe\Programa','plan');
    }

    protected $fillable = [
        'plan','gpo','sem','asignatura',
    ];
}
