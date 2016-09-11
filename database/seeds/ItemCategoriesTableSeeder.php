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
        'category' => 'Whole Birds'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Breasts'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'SKL Fill Breast'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Wings'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Drums'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Thighs'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Combo Packs'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Braai Packs'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Soup Cuts'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Mala'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Heads'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Feet'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Livers'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Hearts'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Necks'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Gizzards'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Breast Bones'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Thigh Bones'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Fat & Skin'
      ]);

      DB::table('item_categories')->insert([
        'category' => 'Skin'
      ]);
    }
}
