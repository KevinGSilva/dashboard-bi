<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Service\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $musics = Music::all();

        return $musics;
    }

    public function artistsByPopularity(Request $request)
    {
        $artists = $this->dashboardService->artistsByPopularity($request['entity'], $request['limit']);

        return $artists;
    }


}