<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = new Carbon();

      // Create Order for Company 3, User 3
      DB::table('orders')->insert([
        'user_id' => '3',
        'orderupdate_id' => '1',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('order_items')->insert([
        'order_id' => '1',
        'item_id' => '1',
        'quantity' => '100',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('orderupdates')->insert([
        'order_id' => '1',
        'status_id' => '1',
        'user_id' => '3',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      // Create another Order for Company 3, User 3
      DB::table('orders')->insert([
        'user_id' => '3',
        'orderupdate_id' => '2',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('order_items')->insert([
        'order_id' => '2',
        'item_id' => '2',
        'quantity' => '200',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('orderupdates')->insert([
        'order_id' => '2',
        'status_id' => '1',
        'user_id' => '3',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      // Create Order for Company 1, User 1
      DB::table('orders')->insert([
        'user_id' => '1',
        'orderupdate_id' => '3',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('order_items')->insert([
        'order_id' => '3',
        'item_id' => '3',
        'quantity' => '300',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('orderupdates')->insert([
        'order_id' => '3',
        'status_id' => '1',
        'user_id' => '1',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      // Create Order for Company 2, User 2
      DB::table('orders')->insert([
        'user_id' => '2',
        'orderupdate_id' => '4',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('order_items')->insert([
        'order_id' => '4',
        'item_id' => '1',
        'quantity' => '400',
        'created_at' => $now,
        'updated_at' => $now
      ]);

      DB::table('orderupdates')->insert([
        'order_id' => '4',
        'status_id' => '1',
        'user_id' => '2',
        'created_at' => $now,
        'updated_at' => $now
      ]);
    }
}
