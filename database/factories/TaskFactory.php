<?php

namespace Database\Factories;


use App\Conference;
use App\Task;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $conference = Conference::inRandomOrder()->first();
        $start = Carbon::create('now')->setTime(8, 0, 0)->addMinutes(random_int(0, 40) * 15); // between 8-18
        $end = $start->copy()->addMinutes(15)->addMinutes(random_int(0, 8) * 15); // Up to 2 hours in 15 min intervals
        return [
            'conference_id' => $conference->id,
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->catchPhrase(),
            'location' => $this->faker->streetAddress(),
            'date' => $this->faker->dateTimeBetween(
                $conference->start_date,
                Carbon::create($conference->end_date)->addDays(1)
            )->setTime(0, 0, 0),
            'start_at' =>  $start->format('H:i:s'),
            'end_at' =>  $end->format('H:i:s'),
            'hours' => round(($end->diffInMinutes($start)) / 60, 2),
            'priority' => $this->faker->numberBetween($min = 1, $max = 3),
            'slots' => $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}