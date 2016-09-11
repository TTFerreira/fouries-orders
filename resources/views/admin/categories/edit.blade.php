@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/categories/{{$category->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'category') }}">
              <label for="category">Category</label>
              <input type="text" name="category" class="form-control" value="{{$category->category}}">
              {{ hasErrorForField($errors, 'category') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Category</b></button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}"><b>Back</b></a></div>
    </div>
  </div>
@endsection
