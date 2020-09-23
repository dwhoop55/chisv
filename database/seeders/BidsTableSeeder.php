<?php

namespace Database\Seeders;

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
        $f = \Faker\Factory::create();
        Conference::all()->each(function ($c) use ($f) {
            $users = $c->users(Role::byName('sv'));
            $tasks = $c->tasks();

            $users->each(function ($u) use ($tasks, &$massBids, $f) {
                $massBids = collect();
                $tasks->each(function ($t) use ($u, &$massBids, $f) {
                    // Only create a bid in 30% of the time
                    if ($f->boolean(30)) {
                        $b = [
                            'user_id' => $u->id,
                            'task_id' => $t->id,
                            'preference' => $f->boolean(2) ? 0 : $f->numberBetween(1, 3),
                        ];
                        $massBids->push($b);
                    }
                });
                // echo "New bids: " . $massBids->count() . "\n";
                DB::table('bids')->insert($massBids->toArray());
                $massBids = collect();
            });
        });
    }
}