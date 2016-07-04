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

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
  Route::auth();
  Route::get('/', ['middleware' => ['role:super-admin'], 'uses' => 'AdminController@index']);
});

Route::group(['middleware' => ['web']], function () {
  Route::auth();
  Route::get('/', 'HomeController@index');
});
