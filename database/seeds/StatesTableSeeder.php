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
            ["id" => 4, "for" => "App\Conference", "name" => "running", "description" => "The conference is running"],
            ["id" => 5, "for" => "App\Conference", "name" => "over", "description" => "The conference is over"],

            ["id" => 11, "for" => "App\User", "name" => "enrolled", "description" => "Waiting to be accepted, waitlisted or dropped"],
            ["id" => 12, "for" => "App\User", "name" => "accepted", "description" => "Accepted to the conference as SV"],
            ["id" => 13, "for" => "App\User", "name" => "waitlisted", "description" => "Waiting to be accepted when other SVs cancel"],
            ["id" => 14, "for" => "App\User", "name" => "dropped", "description" => "Dropped from the conference"],

            ["id" => 21, "for" => "App\Job", "name" => "planned", "description" => "The job is planned to be run in the future"],
            ["id" => 22, "for" => "App\Job", "name" => "processing", "description" => "The job is currently running"],
            ["id" => 23, "for" => "App\Job", "name" => "successful", "description" => "The job finished successfully"],
            ["id" => 24, "for" => "App\Job", "name" => "failed", "description" => "The job stopped and failed"],

        ];
        DB::table('states')->insert($states);
    }
}