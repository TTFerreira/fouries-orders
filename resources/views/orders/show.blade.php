@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
        <section class="invoice">
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                Fouries Poultry Farms PTY LTD
                <small class="pull-right">Date: {{$order->created_at}}</small>
              </h2>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <i>Customer - {{$order->user->name}}</i>
              <address>
                <strong>{{$order->user->company->name}}</strong><br>
                {{$order->user->company->street_number}} {{$order->user->company->street_name}}<br>
                {{$order->user->company->city}}<br>
                {{$order->user->company->postal_code}}<br>
                {{$order->user->company->country}}<br>
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <address>
                <br><br>VAT Number: {{$order->user->company->vat}}<br>
                Phone: {{$order->user->company->telephone}}<br>
                Email: {{$order->user->email}}
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <b>Order #{{$order->id}}</b>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($orderItems as $orderItem)
                    <tr>
                      <td>{{$orderItem->item->item_code}}</td>
                      <td>{{$orderItem->item->description}}</td>
                      <td>{{$orderItem->quantity}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <hr>
          <div class="col-xs-2">
            <form method="POST" action="/orders/{{$order->id}}">
              {{method_field('PATCH')}}
              {{csrf_field()}}
              <div class="form-group {{ hasErrorForClass($errors, 'status') }}">
                <label for="status">Update Order Status</label>
                <select class="form-control status" name="status">
                  @foreach($statuses as $status)
                    <option
                      @if($order->orderupdate->status->id == $status->id)
                        selected
                      @endif
                    value="{{$status->id}}">{{$status->status}}</option>
                  @endforeach
                </select>
                {{ hasErrorForField($errors, 'status') }}
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class='fa fa-pencil-square-o' aria-hidden='true'></span> <b>Update Status</b></button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /.content -->
      <div class="clearfix"></div>
      </div>
    </div>
  </div>
@endsection
