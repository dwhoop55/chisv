<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conference;
use App\Task;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $conference = Conference::inRandomOrder()->first();
    $start = Carbon::create('now')->setTime(10, 0, 0)->addMinutes(random_int(0, 300)); // max 3pm
    $end = Carbon::create('now')->setTime(15, 0, 0)->addMinutes(random_int(0, 180)); // max 6pm
    return [
        'conference_id' => $conference->id,
        'name' => $faker->jobTitle(),
        'description' => $faker->catchPhrase(),
        'location' => $faker->streetAddress(),
        'date' => $faker->dateTimeBetween(
            $conference->start_date,
            $conference->end_date
        )->setTime(0, 0, 0),
        'start_at' =>  $start->format('H:i:s'),
        'end_at' =>  $end->format('H:i:s'),
        'hours' => round(($end->diffInSeconds($start) / 60 / 60) * 2, 2),
        'priority' => $faker->numberBetween($min = 1, $max = 3),
        'slots' => $faker->numberBetween($min = 1, $max = 5),
    ];
});