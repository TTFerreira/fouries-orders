<?php

Route::auth();
Route::group(['middleware' => ['auth', 'role:super-admin']], function () {
  // Admin Page
  route::resource('/admin', 'AdminController', [
    'only' => ['index']
  ]);

  // Users
  Route::resource('/admin/users', 'UsersController', [
    'only' => ['index', 'edit', 'update', 'store'],
    'parameters' => 'singular'
  ]);

  // Companies
  Route::resource('/admin/companies', 'CompaniesController', [
    'only' => ['index', 'edit', 'update', 'store'],
    'parameters' => 'singular'
  ]);
});
Route::get('/', 'HomeController@index');
