<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = new Carbon();
      DB::table('users')->insert([
        'name' => 'Super Admin User',
        'email' => 'superadmin@terryferreira.com',
        'password' => bcrypt('superadmin'),
        'company_id' => 1,
        'remember_token' => str_random(60),
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('users')->insert([
        'name' => 'Admin User',
        'email' => 'adminuser@terryferreira.com',
        'password' => bcrypt('adminuser'),
        'company_id' => 2,
        'remember_token' => str_random(60),
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('users')->insert([
        'name' => 'Customer User',
        'email' => 'customeruser@terryferreira.com',
        'password' => bcrypt('customeruser'),
        'company_id' => 3,
        'remember_token' => str_random(60),
        'created_at' => $now,
        'updated_at' => $now
      ]);
    }
}
