<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
                "name" => "1Sample task name",
                "description" => "1This is a fancy task description",
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
                "name" => "2Sample task name",
                "description" => "2This is a fancy task description",
                "location" => "2 Awesome Road",
                "date" => Carbon::today(),
                "start_at" => "16:00:00",
                "end_at" => "16:15:00",
                "hours" => 2.2,
                "priority" => 2,
                "slots" => 6
            ],
            [
                "conference_id" => 1,
                "name" => "3Sample task name",
                "description" => "3This is a fancy task description",
                "location" => "3 Awesome Road",
                "date" => Carbon::today(),
                "start_at" => "09:00:00",
                "end_at" => "12:04:00",
                "hours" => 6,
                "priority" => 2,
                "slots" => 1
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
            ],


        ];
        DB::table('tasks')->insert($tasks);

        factory(App\Task::class, 3000)->create();
    }
}