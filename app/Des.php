<?php

namespace sispes;

use Illuminate\Database\Eloquent\Model;

class Des extends Model
{
    protected $table = 'des';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plant','nomplant', 'siglas', 'director','asesorp',
    ];
}
