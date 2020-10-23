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
		Route::get('/simulations/add',  ['as'=>'simulation_add', 'uses' => 'SimulationsController@getAdd']);
		Route::post('/simulations/add',  ['uses' => 'SimulationsController@postAdd']);
		Route::get('/simulations/view/{id}',  ['as'=>'simulation_view', 'uses' => 'SimulationsController@getView']);
		Route::post('/simulations/progress-update',  ['uses' => 'SimulationsController@postprogressUpdate']);
		Route::post('/simulations/delete',  ['uses' => 'SimulationsController@postDelete']);

		Route::get('/tutorial-video', ['uses'=>'HomeController@getTutorialVideo']);
		Route::post('/userwatchingvideo',  ['uses' => 'HomeController@postUserWatchingTutorialVideo']);

		Route::get('/questionnaire', ['uses'=>'HomeController@getQuestionnaire']);
		Route::post('/questionnaire', ['uses'=>'HomeController@postQuestionnaire']);

	});

});

Route::get('/test',  ['uses' => 'SimulationsController@getTest']);