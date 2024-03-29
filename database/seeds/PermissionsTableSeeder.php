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
        ];
        DB::table('permissions')->insert($mapping);
    }
}