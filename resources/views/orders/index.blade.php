@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="/orders/create" class="btn btn-primary"><span class='fa fa-cart-plus' aria-hidden='true'></span> <b>Create Order</b></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Order Number</th>
                <th>Company</th>
                <th>Status</th>
                <th>Last Updated By</th>
                <th>Update Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>
                    <div id="company{{$order->id}}" class="hover-pointer">
                      {{$order->user->company->name}}
                    </div>
                  </td>
                  <td>
                    <div id="status{{$order->id}}" class="hover-pointer">
                      @if($order->orderupdate->status->id == 1)
                        <span class="label label-success">
                      @elseif($order->orderupdate->status->id == 3)
                        <span class="label label-info">
                      @elseif($order->orderupdate->status->id == 2)
                        <span class="label label-warning">
                      @elseif($order->orderupdate->status->id == 4)
                        <span class="label label-danger">
                      @endif
                      {{$order->orderupdate->status->status}}</span>
                    </div>
                  </td>
                  <td>{{$order->orderupdate->user->name}} - {{$order->orderupdate->user->company->name}}</td>
                  <td>{{$order->orderupdate->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="/orders/{{ $order->id }}" class="btn btn-primary"><span class='fa fa-file-text-o' aria-hidden='true'></span> <b>View Order</b></a>
                      <a href="/orders/{{ $order->id }}/pdf" class="btn btn-primary"><span class='fa fa-file-pdf-o' aria-hidden='true'></span> <b>PDF</b></a>
                    </div>
                  </td>
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
    var table = $('#table').DataTable( {
      responsive: true,
      columnDefs: [ {
        orderable: false, targets: 5
      } ],
      order: [[ 0, "desc" ]]
    } );
    @foreach($orders as $order)
      var company = (function() {
        var x = '#company' + {{$order->id}};
        return x;
      });
      $(company()).click(function () {
        table.search( "{{$order->user->company->name}}" ).draw();
      });

      var status = (function() {
        var x = '#status' + {{$order->id}};
        return x;
      });
      $(status()).click(function () {
        table.search( "{{$order->orderupdate->status->status}}" ).draw();
      });
    @endforeach
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
