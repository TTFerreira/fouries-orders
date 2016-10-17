@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New Order</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('orders') }}">
            {{csrf_field()}}
            @foreach($itemCategories as $itemCategory)
              <div class="row">
                <h4 class="col-md-12">{{$itemCategory->category}}</h4>
                @foreach($items as $item)
                  @if($item->item_category_id == $itemCategory->id)
                    <div class="col-md-2">
                      <div class="form-group {{ hasErrorForClass($errors, $item->id) }}">
                        <label for="{{$item->id}}">{{$item->item_code}}: {{$item->description}}</label>
                        <input type="number" name="{{$item->id}}" class="form-control" value="{{old($item->id)}}">
                        {{ hasErrorForField($errors, $item->id) }}
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
              <hr>
            @endforeach


            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary"><b>Create Order</b></button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}"><b>Back</b></a></div>
    </div>
  </div>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
