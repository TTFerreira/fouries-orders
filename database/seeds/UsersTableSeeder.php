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
        'company_id' => 1,
        'remember_token' => str_random(10),
      ]);

      DB::table('users')->insert([
        'name' => 'John Doe',
        'email' => 'johndoe@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'company_id' => 1,
        'remember_token' => str_random(10),
      ]);
    }
}
