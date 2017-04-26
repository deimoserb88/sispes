<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::auth();

Route::get('/home', [
		'middleware'=>'auth',
		'uses' => 'HomeController@index'
]);

Route::get('/selectProfile',[
		'middleware'=>'auth',
		'uses' => 'AdminController@index'
]);

/*Docente*/

Route::get('/cambiarPlantel/{des}',[
		'middleware'=>'auth',
		'uses' => 'DocenteController@cambiarPlantel'
]);

Route::get('/selPlantel/{plant}',[
		'middleware'=>'auth',
		'uses' => 'DocenteController@selPlantel'
]);

Route::get('/docenteHome/{plant?}',[
		'middleware'=>'auth',
		'uses' => 'DocenteController@index'
]);


/*Aedmin (responsabel de plantel)*/

Route::get('/adminHome/{rol?}',[
		'middleware'=>'auth',
		'uses' => 'AdminController@index'
]);

Route::get('/matdoc',[
		'middleware'=>'auth',
		'uses' => 'AdminController@matDoc'
]);

Route::get('/matasig',[
		'middleware'=>'auth',
		'uses' => 'AdminController@materiasAsignadas'
]);

Route::get('/listaasig/{plan?}',[
		'middleware'=>'auth',
		'uses' => 'AdminController@listadoAsignaturas'
]);

Route::get('/gruposListar/{programa?}',[
		'middleware'=>'auth',
		'uses' => 'AdminController@listaGrupos'
]);

Route::post('/savematdoc',[
		'middleware'=>'auth',
		'uses' => 'AdminController@saveMatDoc'
]);

Route::post('/materiasPracticas',[
		'middleware'=>'auth',
		'uses' => 'AdminController@materiasPracticas'
]);

/*Root*/

Route::post('/cicloFijar',[
		'middleware'=>'auth',
		'uses' => 'RootController@cicloFijar'
]);

Route::get('/cicloSeleccionar',[
		'middleware'=>'auth',
		'uses' => 'RootController@cicloSeleccionar'
]);

Route::get('/getWebService',[
		'middleware'=>'auth',
		'uses' => 'AdminController@getWebService'
]);

Route::get('/selectPlantel/{plant?}',[
		'middleware'=>'auth',
		'uses' => 'RootController@selectPlantel'
]);


