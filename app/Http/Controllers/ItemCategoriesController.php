<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategories\StoreItemCategoryRequest;
use App\Http\Requests\ItemCategories\UpdateItemCategoryRequest;
use Illuminate\Http\Request;
use Session;
use App\ItemCategory;

use App\Http\Requests;

class ItemCategoriesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Item Categories';
    $categories = ItemCategory::all();
    return view('admin.categories.index', compact('pageTitle', 'categories'));
  }

  public function store(StoreItemCategoryRequest $request)
  {
    ItemCategory::create($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Category: ' . $request->category);
    Session::flash('message', 'Successfully created');

    return redirect()->route('admin.categories.index');
  }

  public function edit(ItemCategory $category)
  {
    $pageTitle = 'Edit Category - ' . $category->category;
    return view('admin.categories.edit', compact('pageTitle', 'category'));
  }

  public function update(UpdateItemCategoryRequest $request, ItemCategory $category)
  {
    $category->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Category: ' . $request->category);
    Session::flash('message', 'Successfully updated');

    return redirect()->route('admin.categories.index');
  }
}
