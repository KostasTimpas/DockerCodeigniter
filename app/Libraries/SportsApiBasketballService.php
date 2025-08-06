<?php

namespace App\Libraries;

class SportsApiBasketballService
{
    protected string $apiUrl = 'https://api.football-data.org//v4/teams/90/';

    protected array $headers;

    public function __construct()
    {
        $this->headers = [
            'X-Auth-Token: b3b236bd49dc442fb896e828d312c829'
        ];
    }


    public function getAllTeams(): array|string|null
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            log_message('error', 'Basketball API cURL Error: ' . $error);
            return null;
        }
        dd(json_decode($response, true));
        return json_decode($response, true);
    }
}
