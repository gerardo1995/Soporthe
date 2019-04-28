<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TaskStatesTableSeeder::class);
        $this->call(TaskTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UsersXTaskTypesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
    }
}
