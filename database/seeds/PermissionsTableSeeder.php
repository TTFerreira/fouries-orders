<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $createUser = new Permission();
      $createUser->name         = 'create-user';
      $createUser->display_name = 'Create Users';
      $createUser->description  = 'Create new users';
      $createUser->save();

      $editUser = new Permission();
      $editUser->name         = 'edit-user';
      $editUser->display_name = 'Edit Users';
      $editUser->description  = 'Edit existing users';
      $editUser->save();

      $createOrder = new Permission();
      $createOrder->name         = 'create-order';
      $createOrder->display_name = 'Create Order';
      $createOrder->description  = 'Create an order';
      $createOrder->save();

      $changeRole = new Permission();
      $changeRole->name         = 'change-role';
      $changeRole->display_name = 'Change Role';
      $changeRole->description  = 'Change a user\'s role';
      $changeRole->save();
    }
}
