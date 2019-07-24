<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\University;
use App\Timezone;
use App\Degree;
use App\Shirt;
use App\City;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName(),
        'lastname' => $faker->lastName(),
        'city_id' => $faker->numberBetween(1, City::all()->count()),
        'university_id' => $faker->numberBetween(1, University::all()->count()),
        'university_fallback' => $faker->optional($weight = 0.5)->company(),
        'shirt_id' => $faker->numberBetween(1, Shirt::all()->count()),
        'degree_id' => $faker->numberBetween(1, Degree::all()->count()),
        'past_conferences' => $faker->text(30),
        'past_conferences_sv' => $faker->text(30),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'timezone_id' => $faker->numberBetween(1, Timezone::all()->count()),
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});