<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Language;
use App\Role;
use App\State;
use App\Conference;
use App\Services\EnrollmentFormService;
use App\User;
use Illuminate\Support\Facades\DB;


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
                'country_id' => 82,
                'region_id' => 1269,
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
                'country_id' => 82,
                'region_id' => 1269,
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
                'country_id' => 82,
                'region_id' => 1269,
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

        $enrollmentFormService = new EnrollmentFormService;
        $form = $enrollmentFormService->removeWeights($enrollmentFormService->getFilledFake());
        $form->save();
        $form->updateTotalWeight();
        $state = State::byName('accepted');
        $role = Role::byName('sv');
        $conference = Conference::inRandomOrder()->first();
        User::find(3)->grant($role, $conference, $state, $form);

        $enrollmentFormService = new EnrollmentFormService;
        $form = $enrollmentFormService->removeWeights($enrollmentFormService->getFilledFake());
        $form->save();
        $form->updateTotalWeight();
        $state = State::byName('accepted');
        $role = Role::byName('sv');
        $conference = Conference::inRandomOrder()->first();
        User::find(1)->grant($role, $conference, $state, $form);

        $faker = app('Faker\Generator');
        $enrollmentFormService = new EnrollmentFormService;
        factory(App\User::class, 3000)->create()->each(function ($user) use ($faker, $role, $enrollmentFormService) {
            $state = State::byName('accepted');

            $conference = Conference::inRandomOrder()->first();
            $language = $faker->numberBetween(1, 70);
            $language2 = $faker->numberBetween(71, 135);

            $form = $enrollmentFormService->getFilledFake();
            $form->save();
            $form->updateTotalWeight();
            $user->grant($role, $conference, $state, $form);

            $user->languages()->attach([$language, $language2]);
        });
    }
}