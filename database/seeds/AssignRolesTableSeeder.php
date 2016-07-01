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
      $admin = Role::where('name', '=', 'super-admin')->first();
      $user->attachRole($admin);

    }
}
