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
                <th>Code</th>
                <th>Description</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
                <tr>
                  <div>
                    <td>{{$item->item_code}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->itemCategory->category}}</td>
                    <td>
                      @if($item->status == 0)
                        <span class="label label-danger">Inactive</span>
                      @else
                        <span class="label label-success">Active</span>
                      @endif
                    </td>
                    <td><a href="/admin/items/{{ $item->id }}/edit" class="btn btn-primary"><span class='fa fa-edit' aria-hidden='true'></span> <b>Edit</b></a></td>
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
          <h3 class="box-title">Create New Item</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/items') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'item_code') }}">
              <label for="item_code">Code</label>
              <input type="text" name="item_code" class="form-control" value="{{old('item_code')}}">
              {{ hasErrorForField($errors, 'item_code') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'item_category_id') }}">
              <label for="item_category_id">Category</label>
              <select class="form-control item_category_id" name="item_category_id">
                <option value = ""></option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'item_category_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'description') }}">
              <label for="description">Description</label>
              <input type="text" name="description" class="form-control" value="{{old('description')}}">
              {{ hasErrorForField($errors, 'description') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Item</b></button>
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
          orderable: false, targets: 4
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
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".item_category_id").select2();
    });
  </script>
@endsection
