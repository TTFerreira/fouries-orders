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

  // Items
  Route::resource('/admin/items', 'ItemsController', [
    'only' => ['index', 'edit', 'update', 'store'],
    'parameters' => 'singular'
  ]);

  // ItemCategories
  Route::resource('/admin/categories', 'ItemCategoriesController', [
    'only' => ['index', 'edit', 'update', 'store'],
    'parameters' => 'singular'
  ]);
});

Route::group(['middleware' => ['auth', 'role:admin|super-admin|customer']], function () {
  // Orders
  Route::get('/orders/{order}/pdf', 'OrdersController@pdf');
  Route::resource('/orders', 'OrdersController', [
    'only' => ['index', 'create', 'show', 'store', 'update'],
    'parameters' => 'singular'
  ]);
});

Route::get('/', 'OrdersController@index');
