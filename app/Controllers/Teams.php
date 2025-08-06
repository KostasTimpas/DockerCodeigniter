<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Teams extends Controller
{
    public function index()
    {
        $basketballService = service('sportsApiBasketballService');
        $response = $basketballService->getAllTeams();

        if (!is_array($response) || !isset($response['response'])) {
            return view('teams', ['teams' => [], 'error' => 'Unable to fetch data']);
        }

        $teams = $response['response'];

        return view('teams/basketball.php', ['teams' => $teams, 'error' => null]);
    }
}
