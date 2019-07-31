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
                'email' => 'admin@chisv.org',
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
                'email' => 'chair@chisv.org',
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
                'email' => 'sv@chisv.org',
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
            $randomStateId = 10 + rand(1, State::where('id', '>', '10')->count());
            $state = State::find($randomStateId);

            $randomConferenceId = rand(1, Conference::count());
            $conference = Conference::find($randomConferenceId);

            $randomLanguageId = rand(1, Language::count());
            $language = Language::find($randomLanguageId);

            $role = Role::byName('sv');

            $user->languages()->attach($language);
            $user->grant($role, $conference, $state);
        });
    }
}