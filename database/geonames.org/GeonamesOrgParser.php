<?php

// NEEDS COMPLETE REIMPLEMENTATION


// $file = "allCountries.txt";
// $cnt = 0;
// $handle = fopen($file, "r");
// if ($handle) {
//     $countries = [];
//     $region = [];
//     while (($line = fgets($handle)) !== false) {
//         $cnt++;
//         if ($cnt == 50000000) {
//             die();
//         }
//         $country = explode("\t", $line);

//         $type = $country[6] . "." . $country[7];
//         switch ($type) {
//             case 'P.PPL': // City
//                 $countries[$country[0]] = [
//                     "name" => htmlspecialchars($country[1], ENT_QUOTES),
//                     "ascii" => htmlspecialchars($country[2], ENT_QUOTES),
//                     "alt" => htmlspecialchars($country[3], ENT_QUOTES),
//                     "lat" => $country[4],
//                     "lon" => $country[5],
//                     "cc" => $country[8],
//                 ];
//                 print_r($countries[$country[0]]);
//                 break;
//             case 'A.ADM1': // Region
//                 break;
//             default:
//                 break;
//         }
//     }

//     fclose($handle);
// } else {
//     echo "$file could not be found at " . __DIR__ . DIRECTORY_SEPARATOR . "$file.\nDownload it from https://download.geonames.org/export/dump/, extract it and place at the expected place.\n";
//     die();
// }
// die();
// $file = "cities500.txt";
// $cnt = 0;
// $handle = fopen($file, "r");
// if ($handle) {
//     while (($line = fgets($handle)) !== false) {
//         $cnt++;
//         if ($cnt == 50000000) {
//             die();
//         }
//         $city = explode("\t", $line);
//         // '{print "(" $1 ", \"" $2 "\", \""  $3 "\", \"" $4 "\", " $5 ", " $6 ", \"" $9 "\", \"" $18 "\"),"}'
//         // $altNames = explode(',', htmlspecialchars($city[3], ENT_QUOTES));

//         $out = "\n(" .
//             $city[0] . ', "' .
//             htmlspecialchars($city[1], ENT_QUOTES) . ', "' .
//             htmlspecialchars($city[2], ENT_QUOTES) . "\", " .
//             $city[4] . ", " .
//             $city[5] . ', "' .
//             htmlspecialchars($city[8], ENT_QUOTES) . '", "' .
//             htmlspecialchars($city[10], ENT_QUOTES) . '", "' .
//             htmlspecialchars($city[11], ENT_QUOTES) . '", "' .
//             htmlspecialchars($city[12], ENT_QUOTES) . '", "' .
//             htmlspecialchars($city[17], ENT_QUOTES) . '"),';
//         print_r($out);
//     }

//     fclose($handle);
// } else {
//     echo "$file could not be found at " . __DIR__ . DIRECTORY_SEPARATOR . "$file.\nDownload it from https://download.geonames.org/export/dump/, extract it and place at the expected place.\n";
//     die();
// }
