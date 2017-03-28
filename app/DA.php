<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class DA extends Model
{
    protected $table = '';

    public static function usar($plt){
    	$this->table = 'da'.$plt;
    }
}
