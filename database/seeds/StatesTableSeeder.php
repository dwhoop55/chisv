<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            // Id 1 has to be always 'planning'!
            ["id" => 1, "for" => "App\Conference", "name" => "planning", "description" => "The conference is invisible to students (only open for administrative purposes)"],
            ["id" => 2, "for" => "App\Conference", "name" => "enrollment", "description" => "Students can enroll in the conference"],
            ["id" => 3, "for" => "App\Conference", "name" => "registration", "description" => "The lottery was run and we are waiting for student registrations"],
            // ["id" => 4, "for" => "App\Conference", "name" => "bidding", "description" => "The tasks are prepared and can be bid for"],
            ["id" => 5, "for" => "App\Conference", "name" => "running", "description" => "The conference is running"],
            ["id" => 6, "for" => "App\Conference", "name" => "over", "description" => "The conference is over"],

            ["id" => 11, "for" => "App\User", "name" => "enrolled", "description" => "Is enrolled, waiting to be accepted, waitlisted or dropped"],
            ["id" => 12, "for" => "App\User", "name" => "waitlisted", "description" => "On the waitlist, waiting to be accepted when other SVs cancel"],
            ["id" => 13, "for" => "App\User", "name" => "accepted", "description" => "Accepted to the conference as SV"],
            ["id" => 14, "for" => "App\User", "name" => "dropped", "description" => "Dropped from the conference"],

        ];
        DB::table('states')->insert($states);
    }
}