<?php

use GuzzleHttp\Client;

if (!function_exists('__')) {
    function __($key)
    {
        $client = new Client(['base_uri' => env('TRANSLATE_URL')]);
        $translate = $client->get('api/translate', ['query' => ['key' => $key, 'locale' => App::getLocale()]]);

        if ($translate->getStatusCode() === 200) {
            return $translate->getBody()->getContents();
        }
    }
}

if (!function_exists('getLocales')) {
    function getLocales()
    {
        $client = new Client(['base_uri' => env('TRANSLATE_URL')]);
        $translate = $client->get('api/locales');

        if ($translate->getStatusCode() == 200) {
            return json_decode($translate->getBody()->getContents());
        }
    }
}