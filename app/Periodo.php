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
    	return $this->belongsTo('sispes\Ciclo');
    }

}
