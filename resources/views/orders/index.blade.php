@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Order Number</th>
                <th>Company</th>
                <th>Status</th>
                <th>Status User</th>
                <th>Status Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->user->company->name}}</td>
                  <td>{{$order->orderupdate->status->status}}</td>
                  <td>{{$order->orderupdate->user->name}} - {{$order->orderupdate->user->company->name}}</td>
                  <td>{{$order->orderupdate->updated_at}}</td>
                  <td><a href="/orders/{{ $order->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
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
