<?php

use Illuminate\Database\Seeder;

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
            // ['user_id' => 1, 'task_id' => 1, 'preference' => 2, 'state_id' => 31],
            ['user_id' => 1, 'task_id' => 2, 'preference' => 3, 'state_id' => 31],
            ['user_id' => 1, 'task_id' => 3, 'preference' => 1, 'state_id' => 31],
            ['user_id' => 2, 'task_id' => 1, 'preference' => 1, 'state_id' => 31],
            ['user_id' => 2, 'task_id' => 2, 'preference' => 1, 'state_id' => 31],
            ['user_id' => 2, 'task_id' => 3, 'preference' => 1, 'state_id' => 31]
        ];

        DB::table('bids')->insert($bids);
    }
}