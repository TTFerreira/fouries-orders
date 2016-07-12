<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use Session;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;

use App\Http\Requests;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Users';
    $users = User::all();
    $companies = Company::all();
    return view('admin.users.index', compact('pageTitle', 'users', 'companies'));
  }

  public function store(StoreUserRequest $request)
  {
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->company_id = $request->company_id;

    $user->save();

    Session::flash('status', 'success');
    Session::flash('title', 'User: ' . $request->name);
    Session::flash('message', 'Successfully created');

    return redirect('admin/users');
  }

  public function edit(User $user)
  {
    $pageTitle = 'Edit User - ' . $user->name;
    $companies = Company::all();
    return view('admin.users.edit', compact('pageTitle', 'user', 'companies'));
  }

  public function update(UpdateUserRequest $request, User $user)
  {
    $user->name = $request->name;
    $user->email = $request->email;
    $user->company_id = $request->company_id;
    $user->update();

    Session::flash('status', 'success');
    Session::flash('title', 'User: ' . $request->name);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/users');
  }
}
