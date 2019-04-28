<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delta = true;
        $ci = 0;
        $ti = 0;
        for($i = 1; $i <= 20; $i++) {
            while($delta) {
                $ci = DB::table('users')->where(['role_id' => 3, 'id' => rand(3, 32) ])->value('id');
                if($ci != 0) {
                    $ti = DB::table('users')->where(['role_id' => 2, 'id' => rand(3, 32) ])->value('id');
                    if($ti != 0) {
                        $delta = false;
                    }
                }
            }
            DB::table('tasks')->insert([
                'task_type_id' => rand(1, 5),
                'technician_id' => $ti,
                'client_id' => $ci,
                'task_state_id' => rand(1, 4),
                'description' => 'none',
                'annotation' => 'none',
                'code' => str_random(20),
                'created_at' => date('Y-m-01').' '.'00:00:00',
                'updated_at' => date('Y-m-01').' '.'00:00:00',
            ]);
            $ci = 0;
            $ti = 0;
            $delta = true;
        }
    }
}
