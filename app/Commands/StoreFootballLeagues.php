<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Services\FootballService;
use App\Models\FootballLeagues;

class StoreFootballLeagues extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'App';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'app:store_football_leagues';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'This command stores football leagues in the database.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'app:store_football_leagues';

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

    public function __construct()
    {

        $this->service = new FootballService();
        $this->leagueModel = new \App\Models\FootballLeagues();
    }

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $apiLeagues = $this->service->listLeagues() ?? [];

        //$FootballLeagueModel = new \App\Models\FootballLeagues();
        foreach ($apiLeagues as $item) {
            $leagueId = $item['league']['id'];

            // Check if the league already exists
            $existing = $this->leagueModel->where('id', $leagueId)->first();

            if ($existing) {
                // League exists, skip to next iteration
                continue;
            }


                $leagueData = [
                    'id' => $item['league']['id'],
                    'name' => $item['league']['name'],
                    'type' => $item['league']['type'],
                    // Add other fields as needed, matching your table's columns
                ];


                try {
                    $this->leagueModel->insert($leagueData);
                } catch (\Exception $e) {
                    echo '<br> Error Here' .$e->getMessage();
                }

                echo "Leagues stored successfully.";
            }
    }
}