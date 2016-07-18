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
                <h2 class="col-md-12">{{$itemCategory->category}}</h2>
                @foreach($items as $item)
                  @if($item->item_category_id == $itemCategory->id)
                    <div class="col-md-2">
                      <div class="form-group {{ hasErrorForClass($errors, $item->item_code) }}">
                        <label for="{{$item->item_code}}">{{$item->item_code}}: {{$item->description}}</label>
                        <input type="number" name="{{$item->item_code}}" class="form-control" value="{{old($item->item_code)}}">
                        {{ hasErrorForField($errors, $item->item_code) }}
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
            @endforeach


            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary"><b>Create Order</b></button>
            </div>
          </form>
        </div>
      </div>
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
