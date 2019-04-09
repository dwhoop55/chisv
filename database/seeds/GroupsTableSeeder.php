<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['id' => 1, 'name' => 'global_admin', 'description' => 'Has all rights'],
            ['id' => 2, 'name' => 'conference_admin', 'description' => 'Has rights to manage one or more specific conferences'],
            ['id' => 3, 'name' => 'student', 'description' => 'Can enroll for conferences as student Voluneer'],

        ];

        DB::table('groups')->insert($groups);
    }
}
