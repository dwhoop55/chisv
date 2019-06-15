<?php
$cnt = 0;
$handle = fopen("cities500.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $cnt++;
        if ($cnt == 50000000) {
            die();
        }
        $city = explode("\t", $line);
        // '{print "(" $1 ", \"" $2 "\", \""  $3 "\", \"" $4 "\", " $5 ", " $6 ", \"" $9 "\", \"" $18 "\"),"}'
        // $altNames = explode(',', htmlspecialchars($city[3], ENT_QUOTES));

        $out = "\n(" .
            $city[0] . ', "' .
            htmlspecialchars($city[1], ENT_QUOTES) . ', "' .
            htmlspecialchars($city[2], ENT_QUOTES) . "\", " .
            $city[4] . ", " .
            $city[5] . ', "' .
            htmlspecialchars($city[8], ENT_QUOTES) . '", "' .
            htmlspecialchars($city[10], ENT_QUOTES) . '", "' .
            htmlspecialchars($city[11], ENT_QUOTES) . '", "' .
            htmlspecialchars($city[12], ENT_QUOTES) . '", "' .
            htmlspecialchars($city[17], ENT_QUOTES) . '"),';
        print_r($out);
    }

    fclose($handle);
} else { }