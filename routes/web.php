<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'v'.env('API_VERSION',1).'/{tenant_id}'], function () use ($router) {
	$router->get('/', function () use ($router) {
		return $router->app->version();
	});

	/* Courses */
	$router->get('/courses', 'CourseController@courses'); //List all courses for a certain tenant

	/* lessons */
	$router->get('/lessons', 'CourseController@lessons'); //List all registrations for a certain tenant

	/* Registrations */
	$router->get('/registrations', 'CourseController@registrations'); //List all registrations for a certain tenant

	//$router->post('/registrations', 'CourseController@registrations'); //Add registrations for a user in a certain tenant
});