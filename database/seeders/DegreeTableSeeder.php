<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degrees = [
            ["id" => 1, "name" => "Bachelor"],
            ["id" => 2, "name" => "Master"],
            ["id" => 3, "name" => "PhD - 1st year"],
            ["id" => 4, "name" => "PhD - 2nd year"],
            ["id" => 5, "name" => "PhD - 3rd year"],
            ["id" => 6, "name" => "PhD - 4th year"],
            ["id" => 7, "name" => "PhD - >5 years"],
            ["id" => 8, "name" => "other"],
        ];
        DB::table('degrees')->insert($degrees);
    }
}