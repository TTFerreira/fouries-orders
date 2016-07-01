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
      $admin = new Role();
      $admin->name         = 'super-admin';
      $admin->display_name = 'Super Administrator';
      $admin->description  = 'Permission to everything';
      $admin->save();

      $customer = new Role();
      $customer->name         = 'customer';
      $customer->display_name = 'Customer';
      $customer->description  = 'A customer that can create orders';
      $customer->save();


    }
}
