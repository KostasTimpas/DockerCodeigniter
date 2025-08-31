<?php

namespace App\Commands;

use App\Models\FootballLeagues;
use App\Models\FootballTeams;
use App\Services\FootballService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class StoreFootballTeams extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = "App";

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = "app:store_football_teams";

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = "This command stores football teams in the database.";

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = "app:store_football_teams";

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    protected FootballService $service;
    protected FootballLeagues $leagueModel;
    protected FootballTeams $teamModel;

    public function __construct()
    {
        $this->service = new FootballService();
        $this->leagueModel = new \App\Models\FootballLeagues();
        $this->teamModel = new \App\Models\FootballTeams();
    }

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $season = "2023";
        // Fetch all leagues (assuming 'id' is your primary key)
        $leagueIds = $this->leagueModel->findColumn("id");
        $inserted = $skipped = $failed = 0;

        foreach ($leagueIds as $id) {
            $leagueId = $id;

            // Fetch teams for this league and season, e.g., 2023
            $league_teams = $this->service->listTeams($leagueId, $season);
            foreach ($league_teams as $team) {
                $teamId = $team["team"]["id"];

                // Check if the team already exists
                if ($this->teamModel->find($teamId)) {
                    $skipped++;
                    continue; // Skip insertion if the team already exists
                }

                $teamModel = $this->teamModel;

                $data = [
                    "id" => $team["team"]["id"],
                    "name" => $team["team"]["name"],
                    "code" => $team["team"]["code"] ?? "Unknown",
                    "country" => $team["team"]["country"] ?? "Unknown",
                    "founded" => $team["team"]["founded"] ?? 0,
                    "national" => $team["team"]["national"], // or true if it's a national team
                    "venue_id" => $team["venue"]["id"], // Replace with an actual venue_id from your venues table
                    "league_id" => $leagueId,
                ];

                try {
                    $teamModel->insert($data);
                    $inserted = ($inserted ?? 0) + 1;
                } catch (\Exception $e) {
                    $failed = ($failed ?? 0) + 1;
                    CLI::error(
                        "Insert failed for league " .
                        $team["team"]["id"] .
                        ": " .
                        $e->getMessage()
                    );
                }
            }

            // Handle $response as needed (e.g., store, log, process)
        }
        echo "Leagues stored successfully.";
        echo "Inserted: {$inserted}, skipped: {$skipped}, failed: {$failed}";
    }
}
