<h4>A new order has been created.</h4>

<h3>Order Details</h3>
<ul>
  <li><b>Order Number:</b> {{$order->id}}</li>
  <li><b>Company:</b> {{$order->user->company->name}}</li>
  <li><b>Order Placed at:</b> {{$order->created_at}}</li>
</ul>

<hr>

<h3><a href="{{url('/orders')}}/{{$order->id}}">View The Order Online</a></h3>
