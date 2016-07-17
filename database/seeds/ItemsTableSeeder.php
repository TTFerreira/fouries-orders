<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('items')->insert([
        'item_code' => '123',
        'description' => 'Chicken Wings'
      ]);

      DB::table('items')->insert([
        'item_code' => '456',
        'description' => 'Half Chicken'
      ]);
    }
}
