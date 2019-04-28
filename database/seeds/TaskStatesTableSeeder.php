<?php

use Illuminate\Database\Seeder;

class TaskStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_states')->insert([
            'name' => 'pendiente'
        ]);

        DB::table('task_states')->insert([
            'name' => 'iniciada'
        ]);

        DB::table('task_states')->insert([
            'name' => 'finalizada'
        ]);

        DB::table('task_states')->insert([
            'name' => 'verificada'
        ]);
    }
}
