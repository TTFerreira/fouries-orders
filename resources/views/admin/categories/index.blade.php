@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Category</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                  <div>
                    <td>{{$category->category}}</td>
                    <td><a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-primary"><span class='fa fa-edit' aria-hidden='true'></span> <b>Edit</b></a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New Category</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/categories') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'category') }}">
              <label for="category">Category</label>
              <input type="text" name="category" class="form-control" value="{{old('category')}}">
              {{ hasErrorForField($errors, 'category') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Category</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 1
        } ],
        order: [[ 0, "asc" ]]
      } );
    } );
  </script>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
