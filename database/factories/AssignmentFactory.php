<?php

namespace Database\Factories;

use App\Assignment;
use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assignment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $task =  Task::inRandomOrder()->first();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'task_id' => $task->id,
            'hours' => $task->hours,
            'state_id' => 43
        ];
    }
}