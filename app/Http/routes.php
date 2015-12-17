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
Route::post('/user/list', 'UserController@getAvailableUsers');
Route::post('/user/insert', 'UserController@store');
Route::get('/user/{id}/contacts', 'UserController@getContacts');
Route::get('/user/{id}/requests', 'UserController@getContactRequests');

Route::get('/requests', 'ContactRequestController@index');
Route::post('/requests/edit', 'ContactRequestController@edit');
Route::post('/requests/insert', 'ContactRequestController@store');

Route::get('/contacts', 'ContactController@index');
Route::post('/contacts/insert', 'ContactController@store');
Route::post('/contacts/delete/{id}', 'ContactController@destroy');
