<?php

namespace Database\Factories;

use App\Bid;
use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'task_id' => Task::inRandomOrder()->first()->id,
            'preference' => $this->faker->numberBetween($this->faker->boolean(20) ? 0 : 1, 3),
            'user_created' => true,
        ];
    }
}