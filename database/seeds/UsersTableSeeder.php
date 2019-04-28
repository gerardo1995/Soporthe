<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('secret'), // secret
            'remember_token' => str_random(10),
            'phone' => rand(96511795, 99741287),
            'role_id' => 1,
            'department_id' => 1,
            'place_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Jefe',
            'email' => 'jefe@correo.com',
            'password' => bcrypt('secret'), // secret
            'remember_token' => str_random(10),
            'phone' => rand(96511795, 99741287),
            'role_id' => 4,
            'department_id' => 3,
            'place_id' => 1,
        ]);

        $u = 0;
        for($p = 1; $p <= 10; $p++) {
            DB::table('users')->insert([
                'name' => 'tecnico' . ($u + 1),
                'email' => 'tecnico' . ($u + 1) . '@correo.com',
                'password' => bcrypt('secret'), // secret
                'remember_token' => str_random(10),
                'phone' => rand(96511795, 99741287),
                'role_id' => 2,
                'department_id' => 1,
                'place_id' => $p,
            ]);

            DB::table('users')->insert([
                'name' => 'tecnico' . ($u + 2),
                'email' => 'tecnico' . ($u + 2) . '@correo.com',
                'password' => bcrypt('secret'), // secret
                'remember_token' => str_random(10),
                'phone' => rand(96511795, 99741287),
                'role_id' => 2,
                'department_id' => 1,
                'place_id' => $p,
            ]);
            $u+=2;
        }

        for($p = 1; $p <= 10; $p++) {
            DB::table('users')->insert([
                'name' => 'cliente' . $p,
                'email' => 'cliente' . $p . '@correo.com',
                'password' => bcrypt('secret'), // secret
                'remember_token' => str_random(10),
                'phone' => rand(96511795, 99741287),
                'role_id' => 3,
                'department_id' => rand(2, 5),
                'place_id' => $p,
            ]);
        }
    }
}
