<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\FootballService;
use CodeIgniter\RESTful\ResourceController;

class FootballController extends ResourceController
{
    protected FootballService $service;

    public function __construct()
    {
        $this->service = new FootballService();
    }

    public function leagues()
    {
        return $this->respond($this->service->listLeagues());
    }
}
