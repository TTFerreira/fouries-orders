<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Terry Ferreira',
        'email' => 'terry@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
      ]);
    }
}
