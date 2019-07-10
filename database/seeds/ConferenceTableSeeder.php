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
            ['id' => 3, 'name' => 'AutomotiveUI 2019', 'key' => 'autoui2019', 'location' => 'Utrecht, Netherlands', 'date' => 'September 22-25, 2019', 'description' => 'AutomotiveUI (or short: AutoUI) is the International ACM SIGCHI Conference on Automotive User Interfaces and Interactive Vehicular Applications. It is the premier forum for UI research in the automotive domain. The conference annually brings together over 200 researchers and practitioners interested in both the technical and the human aspects of in-vehicle user interfaces and applications, to provide a forum for the exchange of technical information concerning research (and practice) and educational activities for motor vehicle user interface development. We have multiple meeting categories in which researchers, practitioners, and other interested parties can take part in our conference and community. We welcome you to engage with us in this exciting field!'],
            ['id' => 4, 'name' => '2019 ACM International Conference on Interactive Surfaces and Spaces', 'key' => 'iss2019', 'location' => 'Daejon, South Korea', 'date' => 'November 10 to 13', 'description' => ''],
        ];

        DB::table('conferences')->insert($conferences);
    }
}