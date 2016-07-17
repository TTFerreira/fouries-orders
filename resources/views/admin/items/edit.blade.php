@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/items/{{$item->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'item_code') }}">
              <label for="item_code">Code</label>
              <input type="text" name="item_code" class="form-control" value="{{$item->item_code}}">
              {{ hasErrorForField($errors, 'item_code') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'description') }}">
              <label for="description">Description</label>
              <input type="text" name="description" class="form-control" value="{{$item->description}}">
              {{ hasErrorForField($errors, 'description') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Item</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
