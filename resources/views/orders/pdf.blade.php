<head>
    <meta charset="UTF-8">
    <title>Fouries Orders @if(isset($pageTitle))- @yield('htmlheader_title', $pageTitle) @endif</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    {{-- Select2 --}}
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- Toastr --}}
    <link href="{{ asset('/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- dataTables --}}
    <link href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
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
  <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}"><b>Back</b></a></div>
</div>
