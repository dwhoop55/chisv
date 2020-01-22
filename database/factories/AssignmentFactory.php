<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assignment;
use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    $task =  Task::inRandomOrder()->first();
    $assignment = [
        'user_id' => User::inRandomOrder()->first()->id,
        'task_id' => $task->id,
        'hours' => $task->hours,
        'state_id' => 43
    ];
    return $assignment;
});