<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('statuses')->insert([
        'status' => 'New'
      ]);

      DB::table('statuses')->insert([
        'status' => 'In Progress'
      ]);

      DB::table('statuses')->insert([
        'status' => 'Sent to Customer'
      ]);

      DB::table('statuses')->insert([
        'status' => 'Canceled'
      ]);
    }
}
