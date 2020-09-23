<?php

namespace Database\Factories;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'country_id' => $this->faker->numberBetween(1, 240),
            'region_id' => $this->faker->numberBetween(1, 4000),
            'city_id' => $this->faker->numberBetween(1, 47000),
            'university_id' => $this->faker->numberBetween(1, 380),
            'university_fallback' => $this->faker->optional($weight = 0.5)->company(),
            'shirt_id' => $this->faker->boolean() ? $this->faker->numberBetween(1, 6) : $this->faker->numberBetween(11, 17),
            'degree_id' => $this->faker->numberBetween(1, 8),
            'past_conferences' => $this->faker->randomElements(['CHI19', 'UIST2020', 'CHI2020', 'MobileHCI', 'DIS 2014', 'NordiCHI 2012'], $this->faker->numberBetween(1, 6)),
            'past_conferences_sv' => $this->faker->randomElements(['CHI19', 'UIST2020', 'CHI2020', 'MobileHCI', 'DIS 2014', 'NordiCHI 2012'], $this->faker->numberBetween(1, 6)),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'timezone_id' => $this->faker->numberBetween(1, 387),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}