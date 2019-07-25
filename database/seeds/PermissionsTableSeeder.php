<?php

use App\State;
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
        $enrolledId = State::byName('enrolled')->id;
        $mapping = [
            ['user_id' => 1, 'role_id' => 1, 'conference_id' => null, 'state_id' => null],
            ['user_id' => 2, 'role_id' => 2, 'conference_id' => 1, 'state_id' => null],
            ['user_id' => 2, 'role_id' => 3, 'conference_id' => 2, 'state_id' => null],
            ['user_id' => 3, 'role_id' => 10, 'conference_id' => 2, 'state_id' => $enrolledId],
        ];
        DB::table('permissions')->insert($mapping);
    }
}