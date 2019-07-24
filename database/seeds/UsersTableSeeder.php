<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Language;
use App\Role;
use App\State;
use App\Conference;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "id" => 1,
                'firstname' => 'ADMIN Milton',
                'lastname' => 'Waddams',
                'email' => 'milton@cs.rwth-aachen.de',
                'email_verified_at' => now(),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'university_id' => 4011,
                'city_id' => 12850,
                'shirt_id' => 1,
                'degree_id' => 2,
                'remember_token' => Str::random(10),
                'timezone_id' => 297,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "id" => 2,
                'firstname' => 'CHAIR+CAPTAIN Florian',
                'lastname' => 'Busch',
                'email' => 'busch@cs.rwth-aachen.de',
                'email_verified_at' => now(),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'university_id' => 4011,
                'city_id' => 12850,
                'shirt_id' => 3,
                'degree_id' => 1,
                'remember_token' => Str::random(10),
                'timezone_id' => 297,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "id" => 3,
                'firstname' => 'SV Florian',
                'lastname' => 'Busch',
                'email' => 'florian.busch@rwth-aachen.de',
                'email_verified_at' => now(),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'university_id' => 4011,
                'city_id' => 12850,
                'shirt_id' => 13,
                'degree_id' => 3,
                'remember_token' => Str::random(10),
                'timezone_id' => 297,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('users')->insert($users);

        factory(App\User::class, 10)->create()->each(function ($user) {
            $state = State::where('id', '>', '10')->orderByRaw('RANDOM()')->take(1)->first();
            $conference = Conference::orderByRaw('RANDOM()')->take(1)->first();
            $language = Language::orderByRaw('RANDOM()')->take(3)->get();
            $role = Role::byName('sv');

            $user->languages()->attach($language);
            $user->grant($role, $conference, $state);
        });
    }
}