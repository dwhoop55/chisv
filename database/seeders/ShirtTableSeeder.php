<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShirtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shirts = [
            ["id" => 1, "cut" => "Straight", "size" => "S"],
            ["id" => 2, "cut" => "Straight", "size" => "M"],
            ["id" => 3, "cut" => "Straight", "size" => "L"],
            ["id" => 4, "cut" => "Straight", "size" => "XL"],
            ["id" => 5, "cut" => "Straight", "size" => "XXL"],
            ["id" => 6, "cut" => "Straight", "size" => "XXXL"],

            ["id" => 11, "cut" => "Tailored", "size" => "XS"],
            ["id" => 12, "cut" => "Tailored", "size" => "S"],
            ["id" => 13, "cut" => "Tailored", "size" => "M"],
            ["id" => 14, "cut" => "Tailored", "size" => "L"],
            ["id" => 15, "cut" => "Tailored", "size" => "XL"],
            ["id" => 16, "cut" => "Tailored", "size" => "XXL"],
            ["id" => 17, "cut" => "Tailored", "size" => "XXXL"],
        ];
        DB::table('shirts')->insert($shirts);
    }
}