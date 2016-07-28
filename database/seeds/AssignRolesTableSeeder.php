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
      $user = User::where('name', '=', 'Super Admin User')->first();
      $superAdmin = Role::where('name', '=', 'super-admin')->first();
      $user->attachRole($superAdmin);

      $user2 = User::where('name', '=', 'Admin User')->first();
      $admin = Role::where('name', '=', 'admin')->first();
      $user2->attachRole($admin);

      $user3 = User::where('name', '=', 'Customer User')->first();
      $customer = Role::where('name', '=', 'customer')->first();
      $user3->attachRole($customer);
    }
}
