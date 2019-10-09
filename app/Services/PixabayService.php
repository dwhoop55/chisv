<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\File;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Illuminate\Support\Facades\Storage;

class Pixabay
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        if ($apiKey == "") {
            Log::warning("Initializing Pixabay without api key");
        }
        $this->apiKey = $apiKey;
    }

    public function search($query, $category = "all", $editorsChoice = "false", $perPage = "10", $page = "1", $type = "photo", $minWidth = 640, $minHeight = 480)
    {
        $client = new Client();
        $res = $client->request(
            'GET',
            'https://pixabay.com/api/?key=' . $this->apiKey .
                '&q=' . urlencode($query) .
                '&category=' . $category .
                '&editors_choice=' . $editorsChoice .
                '&per_page=' . max($perPage, 3) .
                '&page=' . $page .
                '&type=' . $type .
                '&min_width=' . $minWidth .
                '&min_height=' . $minHeight
        );

        $res = $this->handleResponse($res);
        if ($res->has('hits')) {
            return collect($res->get('hits'));
        } else {
            return;
        }
    }

    private function handleResponse($res)
    {
        if ($res->getStatusCode() == 200) {
            // Got result ok
            return collect(json_decode($res->getBody()->getContents()));
        } else if ($res->getStatusCode() == 429) {
            // https://pixabay.com/api/docs/#api_rate_limit
            throw new ThrottleRequestsException("API request exceeded hourly limit: https://pixabay.com/api/docs/#api_rate_limit");
        } else if ($res->getStatusCode() == 400) {
            throw new InvalidParameterException("Invalid or missing API key: https://pixabay.com/api/docs/");
        }
    }

    public function byId($id)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pixabay.com/api/?key=' . $this->apiKey . '&id=' . $id);

        $res = $this->handleResponse($res);
        if ($res->has('hits')) {
            return $res->get('hits')[0];
        } else {
            return;
        }
    }

    public function download($id)
    {
        $image = $this->byId($id);
        $name = $image->id . '.' . pathinfo($image->largeImageURL)['extension'];
        $filename = env('IMAGES_PIXABAY', 'pixabay') . '-' . $name;

        $client = new Client();
        $res = $client->get($image->largeImageURL);
        $content = $res->getBody()->getContents();

        if (Storage::disk('public')->put($filename, $content)) {
            return ['name' => $filename, 'file' => "/storage/$filename"];
        } else {
            return;
        }
    }
}