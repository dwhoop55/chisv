<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'firstname' => 'Mr',
                'lastname' => 'Admin',
                'email' => 'milton@cs.rwth-aachen.de',
                'email_verified_at' => now(),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'university_id' => 1,
                'country_id' => 83,
                'shirt_cut' => 'straight',
                'shirt_size' => 'l',
                'degree' => 'phd',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "id" => 2,
                'firstname' => 'Florian',
                'lastname' => 'Busch',
                'email' => 'busch@cs.rwth-aachen.de',
                'email_verified_at' => now(),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'university_id' => 1,
                'country_id' => 83,
                'shirt_cut' => 'straight',
                'shirt_size' => 'l',
                'degree' => 'master',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "id" => 3,
                'firstname' => 'Florian',
                'lastname' => 'Busch',
                'email' => 'florian.busch@rwth-aachen.de',
                'email_verified_at' => now(),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'university_id' => 1,
                'country_id' => 83,
                'shirt_cut' => 'straight',
                'shirt_size' => 'l',
                'degree' => 'master',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('users')->insert($users);
    }
}
