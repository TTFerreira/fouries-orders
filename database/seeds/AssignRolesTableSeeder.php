<?php

use App\Role;
use App\Permission;
use App\User;
use Illuminate\Database\Seeder;

class AssignRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::where('name', '=', 'Terry Ferreira')->first();
      $superAdmin = Role::where('name', '=', 'super-admin')->first();
      $user->attachRole($superAdmin);

      $user2 = User::where('name', '=', 'John Doe')->first();
      $customer = Role::where('name', '=', 'customer')->first();
      $user2->attachRole($customer);

      $user3 = User::where('name', '=', 'Jane Doe')->first();
      $admin = Role::where('name', '=', 'admin')->first();
      $user3->attachRole($admin);
    }
}
