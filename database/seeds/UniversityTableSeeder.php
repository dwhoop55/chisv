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
        $jsonFile = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "univ.cc" . DIRECTORY_SEPARATOR . "UnivCcParser.json";
        if (file_exists($jsonFile)) {
            $json = json_decode(file_get_contents($jsonFile), true);
            echo "Loading $jsonFile with " . count($json['universities']) . " universities generated " . $json['generated'] . "\n";
            $universities = $json['universities'];
            // We use this cache to only send multiple items to the database
            // than all on their own. This speeds ups seeding by a factor of ..a lot!
            $cache = [];
            $cacheCount = 0;
            foreach ($universities as $key => $university) {
                // echo "Caching (count=$cacheCount) " . $university['name'] . "\n";
                array_push($cache, $university);
                $cacheCount++;
                if ($cacheCount >= 400) {
                    // Cache full enough, send to database
                    // echo "Cache has $cacheCount elements: Writing to database...\n";
                    DB::table('universities')->insert($cache);
                    $cache = [];
                    $cacheCount = 0;
                }
            }
            DB::table('universities')->insert($cache);
            // echo "All universities have been written to the database\n";
        }
    }
}