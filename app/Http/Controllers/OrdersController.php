<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Order;
use App\OrderItem;
use App\Orderupdate;
use App\Item;
use App\ItemCategory;
use App\Status;
use Auth;
use DB;
use Mail;
use PDF;

use App\Http\Requests;

class OrdersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Orders';
    // Get the authenticated user
    $user = Auth::user();
    if ($user->hasRole(['super-admin', 'admin'])) {
      $orders = Order::all();
    } elseif ($user->hasRole('customer')) {
      // Get all users from this user's company
      $users = User::where('company_id', $user->company_id)->pluck('id');
      // Get all orders from this user's company
      $orders = Order::whereIn('user_id', $users)->get();
    }

    return view('orders.index', compact('pageTitle', 'orders'));
  }

  public function create()
  {
    $pageTitle = 'Create Order';
    $categories = DB::table('item_categories')
                         ->join('items', function ($join) {
                           $join->on('item_categories.id', '=', 'items.item_category_id')
                                ->where('items.status', '=', 1);
                         })
                         ->pluck('item_categories.id');
    $array = array();
    foreach ($categories as $itemCategory) {
      $array[] = $itemCategory;
    }
    $categoriesArray = array_unique($array);
    $itemCategories = DB::table('item_categories')
                              ->whereIn('id', $categoriesArray)
                              ->get();
    $items = Item::where('status', 1)->get();
    return view('orders.create', compact('pageTitle', 'itemCategories', 'items'));
  }

  public function store(Request $request)
  {
    // Get the authenticated user
    $user = Auth::user();

    // Save the new order for authenticated user
    $order = new Order();
    $order->user_id = $user->id;
    $order->save();

    $items = Item::all();
    foreach ($items as $item) {
      $description = $item->description;

      // Check if field was filled in. Skip item if field was left blank
      // If not blank, save it as a new order item for this order
      if (isset($request->$description)) {
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->item_id = $item->id;
        $orderItem->quantity = $request->$description;
        $orderItem->save();
      }
    }

    $status = Status::where('status', 'New')->first();

    // Create a new order update for this order and set it to status New for authenticated user
    $orderupdate = new Orderupdate();
    $orderupdate->order_id = $order->id;
    $orderupdate->status_id = $status->id;
    $orderupdate->user_id = $user->id;
    $orderupdate->save();

    // Update the order with the order update id
    $order->orderupdate_id = $orderupdate->id;
    $order->update();

    // Send email to admin
    Mail::send('emails.new-order-admin', ['order' => $order], function ($m) use ($order) {
      $m->to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->subject('New Order: #' . $order->id . ' - ' . $order->user->company->name);
    });

    // Send email to customer
    Mail::send('emails.new-order-customer', ['order' => $order, 'user' => $user], function ($m) use ($order, $user) {
      $m->to($user->email, $user->name)
        ->subject('New Order: #' . $order->id . ' has been sent.');
    });

    // toastr notification
    Session::flash('status', 'success');
    Session::flash('title', 'Order: ' . $order->id . ' for ' . $user->company->name);
    Session::flash('message', 'Successfully created');

    return redirect()->route('orders.index');
  }

  public function show(Order $order)
  {
    $pageTitle = 'Order: ' . $order->id;
    // Get Authenticated User
    $user = Auth::user();
    if ($user->hasRole(['super-admin', 'admin'])) {
      $orderItems = OrderItem::where('order_id', $order->id)->get();
      $statuses = Status::orderBy('id', 'asc')->get();
      return view('orders.show', compact('pageTitle', 'order', 'orderItems', 'statuses'));
    } elseif ($user->hasRole('customer')) {
      // Get all users from this user's company
      $users = User::where('company_id', $user->company_id)->pluck('id');
      // Get all orders from this user's company
      $orders = Order::whereIn('user_id', $users)->pluck('id');
      // Check if authenticated user belongs to this order's company
      foreach ($orders as $thisOrder) {
        if ($thisOrder == $order->id) {
          $orderItems = OrderItem::where('order_id', $order->id)->get();
          $statuses = Status::orderBy('id', 'asc')->get();
          return view('orders.show', compact('pageTitle', 'order', 'orderItems', 'statuses'));
        }
      }
      // Throw a 403 ErrorException if it reaches this, as the user does not belong to the company of this order
      abort(403);
    }
  }

  public function pdf(Order $order)
  {
    $pageTitle = 'Order: ' . $order->id;
    // Get Authenticated User
    $user = Auth::user();
    if ($user->hasRole(['super-admin', 'admin'])) {
      $orderItems = OrderItem::where('order_id', $order->id)->get();
      $statuses = Status::orderBy('id', 'asc')->get();

      $pdf = PDF::loadView('orders.pdf', compact('pageTitle', 'order', 'orderItems', 'statuses'));
      return $pdf->download('order.pdf');
    } elseif ($user->hasRole('customer')) {
      // Get all users from this user's company
      $users = User::where('company_id', $user->company_id)->pluck('id');
      // Get all orders from this user's company
      $orders = Order::whereIn('user_id', $users)->pluck('id');
      // Check if authenticated user belongs to this order's company
      foreach ($orders as $thisOrder) {
        if ($thisOrder == $order->id) {
          $orderItems = OrderItem::where('order_id', $order->id)->get();
          $statuses = Status::orderBy('id', 'asc')->get();
          $pdf = PDF::loadView('orders.pdf', compact('pageTitle', 'order', 'orderItems', 'statuses'));
          return $pdf->download('order.pdf');
        }
      }
      // Throw a 403 ErrorException if it reaches this, as the user does not belong to the company of this order
      abort(403);
    }
  }

  public function update(Request $request, Order $order)
  {
    // Get the authenticated user
    $user = Auth::user();

    $orderupdate = new Orderupdate();
    $orderupdate->order_id = $order->id;
    $orderupdate->status_id = $request->status;
    $orderupdate->user_id = $user->id;
    $orderupdate->save();

    $order->orderupdate_id = $orderupdate->id;
    $order->update();

    // toastr notification
    Session::flash('status', 'success');
    Session::flash('title', 'Order: ' . $order->id . ' for ' . $user->company->name);
    Session::flash('message', 'Status changed to: ' . $orderupdate->status->status);

    return redirect()->route('orders.index');
  }
}
