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

use App\Http\Requests;

class OrdersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $pageTitle = 'Orders';
    $orders = Order::all();
    return view('orders.index', compact('pageTitle', 'orders'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $pageTitle = 'Create Order';
    $itemCategories = ItemCategory::all();
    $items = Item::all();
    return view('orders.create', compact('pageTitle', 'itemCategories', 'items'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
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
      if ($request->$description > 0) {
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

    return redirect('orders');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Order $order)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Order $order)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // public function update(Request $request, Order $order)
  // {
  //     //
  // }
}
