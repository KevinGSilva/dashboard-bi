<?php

namespace App\Service;

use App\Models\Music;
use Illuminate\Support\Facades\DB;
use Phpml\Regression\LeastSquares;

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

    function getCorrelationData()
    {
        $musics = Music::select([
            'popularity',
            'energy',
            'danceability',
            'valence',
            'acousticness',
            'tempo',
        ])->get();

        // Preparando os dados para a análise de regressão
        $samples = [];
        $targets = [];

        foreach ($musics as $music) {
            $samples[] = [
                $music->energy,
                $music->danceability,
                $music->valence,
                $music->acousticness,
                $music->tempo
            ];
            $targets[] = $music->popularity;
        }

        // Aplicando a regressão linear
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Obter os coeficientes da regressão (o impacto de cada atributo na popularidade)
        $coefficients = $regression->getCoefficients();
        $intercept = $regression->getIntercept();
        
        return response()->json([
            'coefficients' => $coefficients,
            'intercept' => $intercept,
            'musics' => $musics
        ]);
    }
}
