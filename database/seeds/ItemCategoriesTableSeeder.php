<?php

use Illuminate\Database\Seeder;

class ItemCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('item_categories')->insert([
        'category' => 'Wings'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Drumsticks'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Breasts'
      ]);
    }
}
