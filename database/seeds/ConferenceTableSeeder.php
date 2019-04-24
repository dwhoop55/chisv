<?php

use Illuminate\Database\Seeder;

class ConferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conferences = [
            ['id' => 1, 'name' => 'CHI 2019', 'key' => 'chi19', 'location' => 'Glasgow', 'date' => 'April', 'description' => 'Awesome people doing awesome things'],
            ['id' => 2, 'name' => 'DIS 2019', 'key' => 'dis19', 'location' => 'Torino', 'date' => 'Sunday June 23 to Friday June 28 2019', 'description' => 'Awesome people doing awesome things'],
        ];

        DB::table('conferences')->insert($conferences);
    }
}
