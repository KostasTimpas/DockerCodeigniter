<?php

namespace App\Repositories;

use CodeIgniter\HTTP\CURLRequest;

class FootballApisRepository
{
    protected CURLRequest $client;

    public function __construct()
    {
        // Example: football-data.org or any API of your choice
        $this->client = \Config\Services::curlrequest([
            'baseURI' => 'https://v3.football.api-sports.io/',
            'timeout' => 15,
            'headers' => [
                'x-rapidapi-key' => 'c15a535ee6cc78ff90a029200bea93ff',    // Store your key in .env
            ],
        ]);

    }

    /** Get all leagues */
    public function getLeagues(): array
    {
        $response = $this->client->get('leagues');
        $data = json_decode($response->getBody(), true);
        $leagues = $data['response'] ?? [];
        return $leagues;
    }

    /** Get fixtures / matches by league */
    public function getFixtures(int $leagueId): array
    {
        $response = $this->client->get("competitions/{$leagueId}/matches");
        return json_decode($response->getBody(), true);
    }

    /** Get odds (example endpoint, depends on provider) */
    public function getOdds(int $matchId): array
    {
        $response = $this->client->get("matches/{$matchId}/odds");
        return json_decode($response->getBody(), true);
    }

    /** Get team statistics */
    public function getTeamStats(int $teamId): array
    {
        $response = $this->client->get("teams/{$teamId}");
        return json_decode($response->getBody(), true);
    }
}