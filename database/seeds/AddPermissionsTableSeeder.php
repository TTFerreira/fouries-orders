<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class AddPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Super Administrator
      $admin = Role::where('name', '=', 'super-admin')->first();
      $createUser = Permission::where('name', '=', 'create-user')->first();
      $editUser = Permission::where('name', '=', 'edit-user')->first();

      $admin->attachPermissions(array($createUser, $editUser));

      // Customer
      $customer = Role::where('name', '=', 'customer')->first();
      $createOrder = Permission::where('name', '=', 'create-order')->first();

      $customer->attachPermissions(array($createOrder));

    }
}
