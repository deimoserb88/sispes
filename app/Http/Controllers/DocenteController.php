<?php

namespace sispes\Http\Controllers;

use Illuminate\Http\Request;

use sispes\Http\Requests;

class DocenteController extends Controller
{
    public function index(Request $request){
    	
    }

    public function selplantel($plantel,Request $request){
    	$request->session()->put('plant',$plantel);
    	return view('docente.home',compact('plantel'));
    }
}
