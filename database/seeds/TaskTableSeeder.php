<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                "conference_id" => 1,
                "name" => "Sample task name",
                "description" => "This is a fancy task description",
                "location" => "1 Awesome Road",
                "date" => Carbon::today(),
                "start_at" => "13:00:00",
                "end_at" => "15:15:00",
                "hours" => 2.5,
                "priority" => 2,
                "slots" => 2
            ],
            [
                "conference_id" => 1,
                "name" => "Two task name",
                "description" => "Description is not optional",
                "location" => "Office",
                "date" => Carbon::yesterday(),
                "start_at" => "09:00:00",
                "end_at" => "12:00:00",
                "hours" => 3,
                "priority" => 1,
                "slots" => 3
            ]

        ];
        DB::table('tasks')->insert($tasks);
    }
}