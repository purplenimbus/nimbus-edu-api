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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/* Courses */
$router->get('{tenant_id}/courses', 'CourseController@courses'); //List all courses for a certain tenant

/* lessons */
$router->get('{tenant_id}/lessons', 'CourseController@lessons'); //List all registrations for a certain tenant

/* Registrations */
$router->get('{tenant_id}/registrations', 'CourseController@registrations'); //List all registrations for a certain tenant

//$router->post('{tenant_id}/registrations', 'CourseController@registrations'); //Add registrations for a user in a certain tenant
