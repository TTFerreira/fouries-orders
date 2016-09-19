<?php

use Illuminate\Database\Seeder;

class TestCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Company::class, 4)->create();
    }
}
