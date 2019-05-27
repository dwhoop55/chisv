<?php

use Illuminate\Database\Seeder;

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
            ["id" => 3, "name" => "PhD"],
        ];
        DB::table('degrees')->insert($degrees);
    }
}