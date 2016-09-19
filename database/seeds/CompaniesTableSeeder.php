<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = new Carbon();

        DB::table('companies')->insert([
          'name' => 'Default Company',
          'telephone' => '018 293 0202',
          'street_number' => '1',
          'street_name' => 'Street Name',
          'city' => 'Potchefstroom',
          'postal_code' => '2520',
          'country' => 'South Africa',
          'created_at' => $now,
          'updated_at' => $now
        ]);
    }
}
