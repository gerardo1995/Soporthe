<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Soporte'
        ]);
        
        DB::table('departments')->insert([
            'name' => 'Ventas'
        ]);

        DB::table('departments')->insert([
            'name' => 'Gerencia'
        ]);

        DB::table('departments')->insert([
            'name' => 'Marketing'
        ]);

        DB::table('departments')->insert([
            'name' => 'Contabilidad'
        ]);
    }
}
