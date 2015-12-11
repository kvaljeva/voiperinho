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

Route::post('/user', 'UserController@getUser');
Route::post('/user/insert', 'UserController@store');

Route::post('/requests', 'ContactRequestController@index');
Route::post('/requests/update', 'ContactRequestController@update');
Route::post('/requests/insert', 'ContactRequestController@store');

Route::post('/contacts', 'ContactsController@index');
Route::post('/contacts/insert', 'ContactsController@store');
Route::post('/contacts/delete', 'ContactsController@destroy');
