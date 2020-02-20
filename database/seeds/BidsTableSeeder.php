<?php

use App\Bid;
use App\Conference;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $bids = [
        //     ['user_id' => 1, 'task_id' => 1, 'preference' => 1],
        //     ['user_id' => 1, 'task_id' => 2, 'preference' => 2],
        //     ['user_id' => 1, 'task_id' => 3, 'preference' => 3],

        //     ['user_id' => 2, 'task_id' => 1, 'preference' => 3],
        //     ['user_id' => 2, 'task_id' => 2, 'preference' => 2],
        //     ['user_id' => 2, 'task_id' => 3, 'preference' => 1],

        //     ['user_id' => 3, 'task_id' => 1, 'preference' => 3],
        //     ['user_id' => 3, 'task_id' => 2, 'preference' => 3],
        //     ['user_id' => 3, 'task_id' => 3, 'preference' => 3],

        //     ['user_id' => 4, 'task_id' => 1, 'preference' => 2],
        //     ['user_id' => 4, 'task_id' => 2, 'preference' => 2],
        //     ['user_id' => 4, 'task_id' => 3, 'preference' => 2],

        //     ['user_id' => 5, 'task_id' => 1, 'preference' => 0],
        //     ['user_id' => 5, 'task_id' => 2, 'preference' => 3],
        //     ['user_id' => 5, 'task_id' => 3, 'preference' => 0],

        //     ['user_id' => 6, 'task_id' => 1, 'preference' => 3],
        //     ['user_id' => 6, 'task_id' => 2, 'preference' => 2],
        //     ['user_id' => 6, 'task_id' => 3, 'preference' => 1],

        // ];

        // DB::table('bids')->insert($bids);

        $f = Faker\Factory::create();
        Conference::all()->each(function ($c) use ($f) {
            $users = $c->users(Role::byName('sv'));
            $tasks = $c->tasks();

            $users->each(function ($u) use ($tasks, &$massBids, $f) {
                $massBids = collect();
                $tasks->each(function ($t) use ($u, &$massBids, $f) {
                    $b = [
                        'user_id' => $u->id,
                        'task_id' => $t->id,
                        'preference' => $f->boolean(2) ? 0 : $f->numberBetween(1, 3),
                    ];
                    $massBids->push($b);
                });
                echo "New bids: " . $massBids->count() . "\n";
                DB::table('bids')->insert($massBids->toArray());
                $massBids = collect();
            });
        });
    }
}