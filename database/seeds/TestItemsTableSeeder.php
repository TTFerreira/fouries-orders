<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TestItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = new Carbon();

      DB::table('items')->insert([
        'item_code' => '123',
        'description' => 'Wings',
        'item_category_id' => 1,
        'created_at' => $now,
        'updated_at' => $now
      ]);

      $now = new Carbon();
      DB::table('items')->insert([
        'item_code' => '456',
        'description' => 'Drumsticks',
        'item_category_id' => 2,
        'created_at' => $now,
        'updated_at' => $now
      ]);

      $now = new Carbon();
      DB::table('items')->insert([
        'item_code' => '789',
        'description' => 'Breasts',
        'item_category_id' => 3,
        'created_at' => $now,
        'updated_at' => $now
      ]);
    }
}
