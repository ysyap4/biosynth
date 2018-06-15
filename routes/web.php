<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('thesis_index',[
	'as' => 'thesis_index',
	'uses' => 'ThesisController@thesis_index',
	]);

Route::get('thesis_show',[
	'as' => 'thesis_show',
	'uses' => 'ThesisController@thesis_show',
	]);

Route::get('thesis_create', [
	'as' => 'thesis_create',
	'uses' => 'ThesisController@thesis_create',
	]);

Route::get('thesis_edit',[
	'as' => 'thesis_edit',
	'uses' => 'ThesisController@thesis_edit',
	]);

Route::post('thesis_create_process', [
	'as' => 'thesis_create_process',
	'uses' => 'ThesisController@thesis_create_process',
	]);

Route::post('thesis_edit_process',[
	'as' => 'thesis_edit_process',
	'uses' => 'ThesisController@thesis_edit_process',
	]);

Route::get('thesis_delete',[
	'as' => 'thesis_delete',
	'uses' => 'ThesisController@thesis_delete',
	]);
