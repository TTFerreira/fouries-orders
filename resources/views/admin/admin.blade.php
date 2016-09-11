@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">User Management</h3>
        </div>
        <div class="box-body">
          <a href="/admin/users" class="btn btn-app">
            <i class="fa fa-group"></i> Users
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Items Management</h3>
        </div>
        <div class="box-body">
          <a href="/admin/items" class="btn btn-app">
            <i class="fa fa-tags"></i> Items
          </a>
          <a href="/admin/categories" class="btn btn-app">
            <i class="fa fa-folder"></i> Categories
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Companies Management</h3>
        </div>
        <div class="box-body">
          <a href="/admin/companies" class="btn btn-app">
            <i class="fa fa-building"></i> Companies
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
