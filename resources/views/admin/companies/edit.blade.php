@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/users/{{$user->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value="{{$user->name}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'email') }}">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" value="{{$user->email}}">
              {{ hasErrorForField($errors, 'email') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit User</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
