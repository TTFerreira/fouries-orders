<?php

namespace App\Http\Controllers;

use App\Http\Requests\Items\StoreItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use Illuminate\Http\Request;
use Session;
use App\Item;
use App\ItemCategory;

use App\Http\Requests;

class ItemsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Items';
    $items = Item::all();
    $categories = ItemCategory::all();
    return view('admin.items.index', compact('pageTitle', 'items', 'categories'));
  }

  public function store(StoreItemRequest $request)
  {
    Item::create($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Item: ' . $request->item_code . ' - ' . $request->description);
    Session::flash('message', 'Successfully created');

    return redirect('admin/items');
  }

  public function edit(Item $item)
  {
    $pageTitle = 'Edit Item - ' . $item->item_code . ' - ' . $item->description;
    $categories = ItemCategory::all();
    return view('admin.items.edit', compact('pageTitle', 'item', 'categories'));
  }

  public function update(UpdateItemRequest $request, Item $item)
  {
    $item->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Item: ' . $request->item_code . ' - ' . $request->description);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/items');
  }
}
