<?php

use Illuminate\Database\Seeder;

class GroupUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminMapping = ['user_id' => 1, 'group_id' => 1];
        DB::table('group_user')->insert($adminMapping);
    }
}
