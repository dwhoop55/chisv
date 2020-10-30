<?php

namespace Database\Seeders;

use App\Assignment;
use App\Conference;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AssignmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Conference::all()->each(function ($conference) {
            $users = $conference->users(Role::byName('sv'))->get();
            $iter = 0;
            $conference->tasks()->getQuery()->each(function ($task) use ($users, &$iter) {
                for ($i = 1; $i <= $task->slots; $i++) {
                    // dump("task: " . $task->id . " " . $iter . " " . $users->count());
                    $user = $users[$iter];
                    $iter = ++$iter % $users->count();
                    (new Assignment([
                        'user_id' => $user->id,
                        'task_id' => $task->id,
                        'hours' => $task->hours,
                        'state_id' => 43,
                    ]))->save();
                }
            });
        });
    }
}