<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountryTableSeeder::class,
            RegionTableSeeder::class,
            CityTableSeeder::class,
            TimezoneTableSeeder::class,
            RolesTableSeeder::class,
            StatesTableSeeder::class,
            LanguageTableSeeder::class,
            ShirtTableSeeder::class,
            DegreeTableSeeder::class,

            UniversityTableSeeder::class,
            ConferenceTableSeeder::class,

            UsersTableSeeder::class,
            LanguageUserSeeder::class,
            PermissionsTableSeeder::class,

        ]);
    }
}