<?php

/**
 * How to use:
 * Just run
 *  php UnivCcParser.php 
 * and the script will fetch all universities from the
 * website and put them in a json (in this folder)
 * The database seeder for universities will pull
 * in the json and seed the universities into the
 * database
 *
 */

function getUrl($page, $domain)
{
    return "https://univ.cc/search.php?dom=$domain&key=&start=$page";
}

function getHtmlForUrl($url)
{
    return file_get_contents($url);
}

$index = getHtmlForUrl(getUrl(1, "world"));
preg_match_all('/<p>Found (\d+) matches/', $index, $matches);
$worldCount = $matches[1][0];
$index = getHtmlForUrl(getUrl(1, "edu"));
preg_match_all('/<p>Found (\d+) matches/', $index, $matches);
$eduCount = $matches[1][0];

$counts = ["world" => $worldCount, "edu" => $eduCount];

echo "Univ.cc has $worldCount (world) and $eduCount (edu) universities in database\n";

$out = fopen(__DIR__ . DIRECTORY_SEPARATOR . "UnivCcParser.json", "w");

$universities = [];
foreach ($counts as $key => $value) {

    for ($i = 1; $i < $value; $i += 50) {
        echo "DOMAIN: $key, Universities left: " . ($value - $i) . "\n";
        $url = getUrl($i, $key);
        $html = getHtmlForUrl($url);
        preg_match_all('/<ol[^>]*>(.*)<\/ol>/', $html, $list);
        preg_match_all('/<li><a href=\'(.*?)\'>(.*?)<\/a><\/li>/', $html, $entries, PREG_SET_ORDER);
        foreach ($entries as $entry) {
            $name = $entry[2];
            $url = $entry[1];
            // The hash will be calculated from the lowercased alphanumeric string
            // We replace non ascii chars like ž with their ascii representative: z
            // This will strip universities with same name
            echo "$name\n";
            $hashSafeName = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
            $hashSafeName =  strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $hashSafeName));
            $nameHash = hash('sha512', $hashSafeName);
            $universities[$nameHash] = ["name" => $name, "url" => $url];
        }
    }
}

$json =  json_encode(["generated" => date("Y-m-d H:i:s"), "universities" => $universities], JSON_PRETTY_PRINT);
echo $json;
fwrite($out, $json);

fclose($out);