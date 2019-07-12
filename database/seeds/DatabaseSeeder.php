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

            LanguageTableSeeder::class,
            ShirtTableSeeder::class,
            DegreeTableSeeder::class,
            UniversityTableSeeder::class,

            UsersTableSeeder::class,

            StatesTableSeeder::class,
            ConferenceTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,

            LanguageUserSeeder::class,

        ]);
    }
}