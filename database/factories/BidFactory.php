<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bid;
use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Bid::class, function (Faker $faker) {
    $bid = [
        'user_id' => User::inRandomOrder()->first()->id,
        'task_id' => Task::inRandomOrder()->first()->id,
        'preference' => $faker->numberBetween($faker->boolean(20) ? 0 : 1, 3)
    ];
    return $bid;
});