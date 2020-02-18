<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
                'name' => 'CHI 2020',
                'key' => 'chi20',
                'state_id' => 4,
                'bidding_enabled' => true,
                'bidding_until' => Carbon::now()->addYear(1),
                'location' => 'Honolulu, Hawaiʻi, USA',
                'timezone_id' => 366,
                'start_date' => Carbon::today()->addDays(-3),
                'end_date' => Carbon::today()->addDays(3),
                'description' => 'Aloha! The ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. CHI – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology. From April 25th to 30th, CHI will, for the first time, take place in beautiful Honolulu, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs generalchairs@chi2020.acm.org',
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
            // [
            //     'id' => 3,
            //     'name' => 'AutomotiveUI 2019',
            //     'key' => 'autoui2019',
            //     'state_id' => 1,
            //     'location' => 'Utrecht, Netherlands',
            //     'timezone_id' => 297,
            //     'start_date' => '2019-09-22',
            //     'end_date' => '2019-09-25',
            //     'description' => 'AutomotiveUI (or short: AutoUI) is the International ACM SIGCHI Conference on Automotive User Interfaces and Interactive Vehicular Applications. It is the premier forum for UI research in the automotive domain. The conference annually brings together over 200 researchers and practitioners interested in both the technical and the human aspects of in-vehicle user interfaces and applications, to provide a forum for the exchange of technical information concerning research (and practice) and educational activities for motor vehicle user interface development. We have multiple meeting categories in which researchers, practitioners, and other interested parties can take part in our conference and community. We welcome you to engage with us in this exciting field!',
            // ],
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