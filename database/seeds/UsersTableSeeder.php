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
        'name' => 'Terry Ferreira',
        'email' => 'terry@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'company_id' => 1,
        'remember_token' => str_random(60),
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('users')->insert([
        'name' => 'John Doe',
        'email' => 'johndoe@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'company_id' => 2,
        'remember_token' => str_random(60),
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('users')->insert([
        'name' => 'Jane Doe',
        'email' => 'janedoe@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'company_id' => 3,
        'remember_token' => str_random(60),
        'created_at' => $now,
        'updated_at' => $now
      ]);
    }
}
