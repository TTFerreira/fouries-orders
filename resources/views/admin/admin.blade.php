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
  </div>
@endsection
