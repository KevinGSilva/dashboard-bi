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

    public function getPopularityByYear()
    {
        $popularity = $this->dashboardService->getPopularityByYear();

        return $popularity;
    }

    public function getPopularityByDecade()
    {
        $popularity = $this->dashboardService->getPopularityByDecade();

        return $popularity;
    }

    public function getCorrelationData()
    {
        $correlationData = $this->dashboardService->getCorrelationData();

        return $correlationData;
    }

    public function getMusicStats(Request $request)
    {
        $musicStats = $this->dashboardService->getMusicStats($request['limit']);

        return $musicStats;
    }

}
