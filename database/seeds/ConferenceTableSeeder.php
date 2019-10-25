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
            [
                'id' => 1,
                'name' => 'CHI 2019',
                'key' => 'chi19',
                'state_id' => 6,
                'location' => 'Glasgow',
                'timezone_id' => 311,
                'start_date' => '2019-03-01',
                'end_date' => '2019-03-05',
                'description' => 'Awesome people doing awesome things',
            ],
            // [
            //     'id' => 2,
            //     'name' => 'DIS 2019',
            //     'key' => 'dis19',
            //     'state_id' => 6,
            //     'location' => 'Torino',
            //     'timezone_id' => 297,
            //     'start_date' => '2019-06-23',
            //     'end_date' => '2019-06-28',
            //     'description' => 'Awesome people doing awesome things',
            // ],
            [
                'id' => 3,
                'name' => 'AutomotiveUI 2019',
                'key' => 'autoui2019',
                'state_id' => 1,
                'location' => 'Utrecht, Netherlands',
                'timezone_id' => 297,
                'start_date' => '2019-09-22',
                'end_date' => '2019-09-25',
                'description' => 'AutomotiveUI (or short: AutoUI) is the International ACM SIGCHI Conference on Automotive User Interfaces and Interactive Vehicular Applications. It is the premier forum for UI research in the automotive domain. The conference annually brings together over 200 researchers and practitioners interested in both the technical and the human aspects of in-vehicle user interfaces and applications, to provide a forum for the exchange of technical information concerning research (and practice) and educational activities for motor vehicle user interface development. We have multiple meeting categories in which researchers, practitioners, and other interested parties can take part in our conference and community. We welcome you to engage with us in this exciting field!',
            ],
            // [
            //     'id' => 4,
            //     'name' => '2019 ACM International Conference on Interactive Surfaces and Spaces',
            //     'key' => 'iss2019',
            //     'state_id' => 2,
            //     'location' => 'Daejon, South Korea',
            //     'timezone_id' => 297,
            //     'start_date' => '2019-11-10',
            //     'end_date' => '2019-11-13',
            //     'description' => '',
            // ],
        ];

        DB::table('conferences')->insert($conferences);
    }
}