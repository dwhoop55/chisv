<?php

use Illuminate\Database\Seeder;

class LanguageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mappings = [
            ["user_id" => "1", "language_id" => "10"],
            ["user_id" => "1", "language_id" => "13"],
        ];
        DB::table('language_user')->insert($mappings);
    }
}