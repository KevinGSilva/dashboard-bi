<?php

namespace App\Service;

use App\Models\Music;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

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


}
