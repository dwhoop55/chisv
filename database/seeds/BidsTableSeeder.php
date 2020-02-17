<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bids = [
            ['user_id' => 1, 'task_id' => 1, 'preference' => 1],
            ['user_id' => 1, 'task_id' => 2, 'preference' => 2],
            ['user_id' => 1, 'task_id' => 3, 'preference' => 3],

            ['user_id' => 2, 'task_id' => 1, 'preference' => 3],
            ['user_id' => 2, 'task_id' => 2, 'preference' => 2],
            ['user_id' => 2, 'task_id' => 3, 'preference' => 1],

            ['user_id' => 3, 'task_id' => 1, 'preference' => 3],
            ['user_id' => 3, 'task_id' => 2, 'preference' => 3],
            ['user_id' => 3, 'task_id' => 3, 'preference' => 3],

            ['user_id' => 4, 'task_id' => 1, 'preference' => 2],
            ['user_id' => 4, 'task_id' => 2, 'preference' => 2],
            ['user_id' => 4, 'task_id' => 3, 'preference' => 2],

            ['user_id' => 5, 'task_id' => 1, 'preference' => 0],
            ['user_id' => 5, 'task_id' => 2, 'preference' => 3],
            ['user_id' => 5, 'task_id' => 3, 'preference' => 0],

            ['user_id' => 6, 'task_id' => 1, 'preference' => 3],
            ['user_id' => 6, 'task_id' => 2, 'preference' => 2],
            ['user_id' => 6, 'task_id' => 3, 'preference' => 1],

        ];

        DB::table('bids')->insert($bids);
    }
}