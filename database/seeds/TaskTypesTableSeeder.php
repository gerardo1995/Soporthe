<?php

use Illuminate\Database\Seeder;

class TaskTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_types')->insert([
            'name' => 'Monitor'
        ]);

        DB::table('task_types')->insert([
            'name' => 'Impresora'
        ]);

        DB::table('task_types')->insert([
            'name' => 'CPU'
        ]);

        DB::table('task_types')->insert([
            'name' => 'Aire Acondicionado'
        ]);

        DB::table('task_types')->insert([
            'name' => 'Internet'
        ]);
    }
}
