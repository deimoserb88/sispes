<?php

namespace sispes;

use Illuminate\Http\Request;
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

    
    public function plantelActivo(Request $request,$plant=""){
        if ($plant=="vg") {
    		$request->session()->forget('plant');
            return "";	            
        }elseif($plant!=""){
            $request->session()->put('plant',$plant);
            return $this->select('siglas')->where('plant','=',$plant)->get();
        }else{
        	return $this->select('siglas')->where('plant','=',$request->session()->get('plant'))->get();
        }
    }
}
