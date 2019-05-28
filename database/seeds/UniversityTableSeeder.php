<?php

use Illuminate\Database\Seeder;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $universities = [
            ["id" => 1, "name" => "RWTH Aachen University"],
            ["id" => 2, "name" => "TU Munich"],
        ];
        DB::table('universities')->insert($universities);
    }
}