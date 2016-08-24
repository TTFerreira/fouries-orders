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
            <div class="form-group {{ hasErrorForClass($errors, 'item_category_id') }}">
              <label for="item_category_id">Company</label>
              <select class="form-control item_category_id" name="item_category_id">
                @foreach($categories as $category)
                  <option
                    @if($item->item_category_id == $category->id)
                      selected
                    @endif
                  value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'item_category_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'status') }}">
              <label for="status">Status</label>
              <select class="form-control status" name="status">
                <option
                  @if($item->status == 0)
                    selected
                  @endif
                value="0">Inactive</option>
                <option
                  @if($item->status == 1)
                    selected
                  @endif
                value="1">Active</option>
              </select>
              {{ hasErrorForField($errors, 'status') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Item</b></button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}"><b>Back</b></a></div>
    </div>
  </div>
@endsection
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".item_category_id").select2();
    });
  </script>
@endsection
