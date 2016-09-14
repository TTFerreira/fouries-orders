<head>
  <meta charset="UTF-8">
  <title>Fouries Orders @if(isset($pageTitle))- @yield('htmlheader_title', $pageTitle) @endif</title>
  <!-- Bootstrap 3.3.4 -->
  <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{$pageTitle}}</h3>
      </div>
      <div class="box-body">
      <section class="invoice">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-header">
              Fouries Poultry Farms PTY LTD
            </h2>
          </div>
        </div>
        <div class="row invoice-info">
            <i>Created by - {{$order->user->name}} - {{$order->user->company->name}}</i><br>
            <small class="pull-right"><strong>Date: </strong>{{$order->created_at}}</small><br>
            <strong>Order: {{$order->id}}</strong>
            <hr>
            <address>
              <strong>{{$order->user->company->name}}</strong><br>
              <strong>Address: </strong>{{$order->user->company->street_number}} {{$order->user->company->street_name}}, {{$order->user->company->city}}, {{$order->user->company->postal_code}}, {{$order->user->company->country}}<br>
              <strong>VAT Number: </strong>{{$order->user->company->vat}}<br>
              <strong>Phone: </strong>{{$order->user->company->telephone}}<br>
              <strong>Fax: </strong>{{$order->user->company->fax}}<br>
              <strong>Email: </strong>{{$order->user->email}}
            </address>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <br>
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
    </section>
    </div>
  </div>
</div>
</div>
