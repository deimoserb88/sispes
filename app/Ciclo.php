<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $table = 'ciclo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'desc','cde', 'ca', 'activo',
    ];

}
