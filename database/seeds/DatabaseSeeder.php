<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AddPermissionsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);

        // Comment these 3 seeds if you want to seed your test DB
        $this->call(CompaniesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AssignRolesTableSeeder::class);

        // Uncomment these 3 seeds when seeding test DB
        //
        // $this->call(TestCompaniesTableSeeder::class);
        // $this->call(TestUsersTableSeeder::class);
        // $this->call(TestAssignRolesTableSeeder::class);
    }
}
