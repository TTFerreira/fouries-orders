<h3>{{$user->name}}, your order has been sent successfully.</h3>
<p>Your order will be processed as soon as possible.</p>

<h4>Order Details</h4>
<ul>
  <li><b>Order Number:</b> {{$order->id}}</li>
  <li><b>Company:</b> {{$order->user->company->name}}</li>
  <li><b>Order Placed at:</b> {{$order->created_at}}</li>
</ul>

<hr>

<h3><a href="{{url('/orders')}}/{{$order->id}}">View The Order Online</a></h3>
