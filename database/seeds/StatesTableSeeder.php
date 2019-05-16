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
            ["id" => 1, "name" => "planning", "description" => "The conference is invisible to students (only open for administrative purposes)"],
            ["id" => 2, "name" => "enrollment", "description" => "Students can enroll in the conference"],
            ["id" => 3, "name" => "registration", "description" => "The lottery was run and we are waiting for student registrations"],
            ["id" => 4, "name" => "bidding", "description" => "The tasks are prepared and can be bid for"],
            ["id" => 5, "name" => "running", "description" => "The conference is running"],
            ["id" => 6, "name" => "over", "description" => "The conference is over"],

            ["id" => 11, "name" => "unenrolled", "description" => "The user is not enrolled"],
            ["id" => 12, "name" => "enrolled", "description" => "The user is enrolled"],
            ["id" => 13, "name" => "waitlisted", "description" => "The user is on the waitlist (not accepted)"],
            ["id" => 14, "name" => "accepted", "description" => "The user is accepted to the conference"],
            ["id" => 15, "name" => "registered", "description" => "The user has registered for the conference (this requires a separate step by the user and must be tracked manually)"],
            ["id" => 16, "name" => "on-site", "description" => "The user is on site and ready to take jobs"],
            ["id" => 17, "name" => "dropped", "description" => "The user was dropped from the conference"],

        ];
        DB::table('states')->insert($states);
    }
}
