<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $superAdmin = new Role();
      $superAdmin->name         = 'super-admin';
      $superAdmin->display_name = 'Super Administrator';
      $superAdmin->description  = 'Permission to everything';
      $superAdmin->save();

      $admin = new Role();
      $admin->name         = 'admin';
      $admin->display_name = 'Administrator';
      $admin->description  = 'Permission to add/edit users, but not their roles.';
      $admin->save();

      $customer = new Role();
      $customer->name         = 'customer';
      $customer->display_name = 'Customer';
      $customer->description  = 'A customer that can create orders';
      $customer->save();


    }
}
