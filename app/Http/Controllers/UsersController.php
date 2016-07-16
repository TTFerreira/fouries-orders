<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Role;
use Session;
use DB;
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
    $usersRoles = DB::table('role_user')->get();
    $roles = Role::all();
    return view('admin.users.index', compact('pageTitle', 'users', 'companies', 'usersRoles', 'roles'));
  }

  public function store(StoreUserRequest $request)
  {
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->company_id = $request->company_id;

    $user->save();

    // Assign the 'Customer' role to the new user by default
    $customer = Role::where('name', '=', 'customer')->first();
    $user->attachRole($customer);

    // Toastr popup upon successful user creation
    Session::flash('status', 'success');
    Session::flash('title', 'User: ' . $request->name);
    Session::flash('message', 'Successfully created');

    return redirect('admin/users');
  }

  public function edit(User $user)
  {
    $pageTitle = 'Edit User - ' . $user->name;
    $companies = Company::all();
    $usersRoles = DB::table('role_user')->get();
    $roles = Role::all();
    return view('admin.users.edit', compact('pageTitle', 'user', 'companies', 'usersRoles', 'roles'));
  }

  public function update(UpdateUserRequest $request, User $user)
  {
    $user->name = $request->name;
    $user->email = $request->email;
    $user->company_id = $request->company_id;
    $user->update();

    // Update the user's role
    DB::table('role_user')
            ->where('user_id', $user->id)
            ->update(['role_id' => $request->role_id]);

    // Toastr popup upon successful user update
    Session::flash('status', 'success');
    Session::flash('title', 'User: ' . $request->name);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/users');
  }
}
