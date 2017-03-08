<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = '';

    public static function usar($plt){
    	$table = 'd'.$plt;
    }
    
	protected $fillable = [
        'id','notrab', 'nom', 'apat','amat','email','created_at','updated_at',
    ];    
    
}
