<?php

namespace App\Service;

use App\Models\Music;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function artistsByPopularity($entity, $limit)
    {
        $column = getEntity($entity);

        $artistsPopularity = Music::all()
                ->groupBy($column)
                ->map(function ($musics) {
                    return number_format($musics->avg('popularity'), 3, '.', '');
                })
                ->sortDesc();
        
        if ($limit) {
            $artistsPopularity = $artistsPopularity->take($limit);
        }
        
        $response = [
            'labels' => $artistsPopularity->keys()->toArray(),
            'datasets' => $artistsPopularity->values()->toArray(),
        ];
    
        return response()->json($response);
    }

    public function getPopularityByYear()
    {
        $popularityByYear = Music::select('year', DB::raw('AVG(popularity) as avg_popularity'))
                            ->groupBy('year')
                            ->orderBy('year')
                            ->get();


        return response()->json($popularityByYear);
    }

    public function getPopularityByDecade()
    {
        $popularityByDecade = Music::select(DB::raw('FLOOR(year / 10) * 10 as decade'), DB::raw('AVG(popularity) as avg_popularity'))
            ->groupBy(DB::raw('FLOOR(year / 10) * 10'))
            ->orderBy('decade')
            ->get();

        return response()->json($popularityByDecade);
    }

}
