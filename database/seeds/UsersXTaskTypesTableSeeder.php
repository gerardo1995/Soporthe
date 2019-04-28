<?php

use Illuminate\Database\Seeder;

class UsersXTaskTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($p = 1; $p <= 10; $p++) {
            for($tt = 1; $tt <= 5; $tt++) {
                $t = DB::table('users')->where(['place_id' => $p, 'role_id' => 2])->pluck('id')->random();
                DB::table('users_x_task_types')->insert([
                    'task_type_id' => $tt,
                    'user_id' => $t
                ]);
            }
        }
    }
}
