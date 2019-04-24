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
            ['id' => 1, 'key' => 'globalAdmin', 'description' => 'Can do anything'],
            ['id' => 2, 'key' => 'confAdmin', 'description' => 'Can manage conference details'],
            ['id' => 3, 'key' => 'svAdmin', 'description' => 'Can manage SVs enrolled on in conference'],
            ['id' => 10, 'key' => 'sv', 'description' => 'Can enroll for conferences as SV'],
        ];

        DB::table('roles')->insert($roles);
    }
}
