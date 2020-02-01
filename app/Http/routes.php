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

Route::group(['middleware' => 'beforeFilter'], function () {

	Route::get('login', ['as'=>'login','uses'=>'UsersController@getLogin']);
	Route::post('login',['uses'=>'UsersController@postLogin']);
	Route::get('register', ['as'=>'registration_view','uses'=>'UsersController@getRegistration']);
	Route::post('register', ['uses'=>'UsersController@postRegistration']);
	Route::get('logout', ['as'=>'users_logout','uses'=>'UsersController@getLogout']);

	Route::group(['middleware' => ['auth']], function(){

		Route::get('/', ['as'=>'index','uses'=>'HomeController@getHomepage']);
		Route::get('/projects/add',  ['uses' => 'ProjectsController@getAdd']);
		Route::post('/projects/add',  ['uses' => 'ProjectsController@postAdd']);
		Route::get('/projects/edit/{id}',  ['uses' => 'ProjectsController@getEdit']);
		Route::get('/projects/delete/{id}',  ['uses' => 'ProjectsController@getDelete']);
		Route::post('/projects/edit',  ['uses' => 'ProjectsController@postEdit']);
		Route::get('/simulations/index/{id}',  ['as'=>'simulation_index', 'uses' => 'SimulationsController@getIndex']);
		Route::get('/simulations/add/{id}',  ['as'=>'simulation_add', 'uses' => 'SimulationsController@getAdd']);
		Route::get('/simulations/delete/{simid}/{projectid}',  ['as'=>'simulation_delete', 'uses' => 'SimulationsController@getDelete']);
		Route::post('/simulations/add',  ['uses' => 'SimulationsController@postAdd']);
		Route::get('/simulations/edit/{id}',  ['as'=>'simulation_edit', 'uses' => 'SimulationsController@getEdit']);
		Route::post('/simulations/edit',  ['uses' => 'SimulationsController@postEdit']);
		Route::get('/simulations/view/{id}',  ['as'=>'simulation_view', 'uses' => 'SimulationsController@getView']);

	});

});