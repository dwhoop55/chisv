<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'admin', 'description' => 'Can do anything'],
            ['id' => 2, 'name' => 'chair', 'description' => 'Can manage conference details, tasks and assignments'],
            ['id' => 3, 'name' => 'captain', 'description' => 'Can manage tasks and assignments'],
            ['id' => 10, 'name' => 'sv', 'description' => 'Is associated for conferences as SV'],
        ];

        DB::table('roles')->insert($roles);
    }
}