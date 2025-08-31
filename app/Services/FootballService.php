<?php

namespace App\Services;

use App\Repositories\FootballApisRepository;

class FootballService
{
    protected FootballApisRepository $repository;

    public function __construct()
    {
        $this->repository = new FootballApisRepository();
    }

    public function listLeagues(): array
    {
        return $this->repository->getLeagues();
    }

    public function listTeams($leagueId, $season): array
    {
        return $this->repository->getTeams($leagueId, $season);
    }
}