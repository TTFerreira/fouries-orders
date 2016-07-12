<?php

Route::auth();
Route::group(['middleware' => ['auth', 'role:super-admin']], function () {
  Route::resource('/admin/users', 'UsersController', [
    'only' => ['index', 'edit', 'update', 'store'],
    'parameters' => 'singular'
  ]);

  Route::resource('/admin/companies', 'CompaniesController', ['only' => [
    'index', 'store'
  ]]);
});
Route::get('/', 'HomeController@index');
