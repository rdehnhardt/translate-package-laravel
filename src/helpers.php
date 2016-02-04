<?php

use GuzzleHttp\Client;
use App;

if (!function_exists('__')) {
    function __($key)
    {
        $client = new Client(['base_uri' => env('TRANSLATE_URL')]);
        $translate = $client->get('translate', ['query' => ['key' => $key, 'locale' => App::getLocale()]]);

        if ($translate->getStatusCode() == 200) {
            $message = json_decode($translate->getBody()->getContents());

            if ($message->status) {
                return $message->message;
            }
        }
    }
}

if (!function_exists('getLocales')) {
    function getLocales()
    {
        $client = new Client(['base_uri' => env('TRANSLATE_URL')]);
        $translate = $client->get('locales');

        if ($translate->getStatusCode() == 200) {
            return json_decode($translate->getBody()->getContents());
        }
    }
}