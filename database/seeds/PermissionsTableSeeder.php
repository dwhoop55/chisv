<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapping = [
            ['user_id' => 1, 'role_id' => 1, 'conference_id' => null],
            ['user_id' => 2, 'role_id' => 2, 'conference_id' => 1],
            ['user_id' => 2, 'role_id' => 3, 'conference_id' => 1],
            ['user_id' => 3, 'role_id' => 10, 'conference_id' => 2],
        ];
        DB::table('permissions')->insert($mapping);
    }
}
