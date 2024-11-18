@extends('layouts.common.public')

@section('content')
<div class="row bg-primary mb-2">
    <div class="col-md-12 d-flex justify-content-center text-center">
        <span class="text-white h3 p-3">Dashboard Classic Metal</span>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row col-sm-12 col-lg-8">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <h4>Entidades mais populares</h4>
                        <div class="filter col-lg-4 d-flex justify-content-between">
                            <div class="col-lg-5">
                                <label for="entity">Entidade</label>
                                <select class="form-select select-popularity" id="filter-popularity-entity" name="entity">
                                    @foreach (getEntity() as $key => $item)
                                        <option value="{{ $key }}" {{ $key == 1 ? 'selected' : '' }}>{{ getEntityTranslated($key) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5">
                                <label for="limit">Quantidade</label>
                                <select class="form-select select-popularity" id="filter-popularity-limit" name="limit">
                                    <option value="">Todos</option>
                                    <option value="10" selected>Top 10</option>
                                    <option value="50">Top 50</option>
                                    <option value="100">Top 100</option>
                                    <option value="200">Top 200</option>
                                    <option value="400">Top 400</option>
                                    <option value="800">Top 800</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 graph-canvas">
                        <canvas class="ms-1 me-1" id="chart-artists-popularity"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row col-sm-12 col-lg-8">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col-lg-12">
                            <h4>Popularidade média por ano</h4>
                        </div>
                    </div>
                    <div class="col-lg-12 graph-canvas">
                        <canvas class="ms-1 me-1" id="chart-year-popularity"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row col-sm-12 col-lg-8">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col-lg-12">
                            <h4>Popularidade média por década</h4>
                        </div>
                    </div>
                    <div class="col-lg-12 graph-canvas">
                        <canvas class="ms-1 me-1" id="chart-decade-popularity"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row col-sm-12 col-lg-9">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col-lg-12">
                            <h4>Correlação entre Popularidade e Características Musicais</h4>
                        </div>
                    </div>
                    <div class="col-lg-12 graph-canvas">
                        <canvas class="ms-1 me-1" id="popularityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row col-sm-12 col-lg-12">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col-lg-12">
                            <h4>Coeficientes da Regressão Linear</h4>
                        </div>
                    </div>
                    <div class="col-lg-12 graph-canvas">
                        <ul id="regressionCoefficients"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="col-sm-12 col-lg-8">
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="col-lg-12">
                                    <h4>Variação da energia e dançabilidade</h4>
                                </div>
                            </div>
                            <div class="col-lg-12 graph-canvas">
                                <canvas class="ms-1 me-1" id="chart-energy-danceability"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="col-sm-12 col-lg-9">
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="col-lg-8">
                                    <h4>Média de energia por álbum</h4>
                                </div>
                                <div class="col-lg-4">
                                    <label for="limit">Quantidade</label>
                                    <select class="form-select select-popularity" id="filter-energy-limit" name="limit">
                                        <option value="">Todos</option>
                                        <option value="10" selected>Top 10</option>
                                        <option value="50">Top 50</option>
                                        <option value="100">Top 100</option>
                                        <option value="200">Top 200</option>
                                        <option value="400">Top 400</option>
                                        <option value="800">Top 800</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 graph-canvas">
                                <canvas class="ms-1 me-1" id="chart-album-energy"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script type="text/javascript">
var chartArtistsPopularity = null;
var chartYearPopularity = null;
var chartDecadePopularity = null;
var chartCorrelationPopularity = null;
var chartDanceabilityEnergy = null;
var chartAlbumEnergy = null;

jQuery(document).ready(function ($) {
    getArtistPopularityData();
    getYearPopularityData();
    getDecadePopularityData();
    getCorrelationPopularityData();
    getDanceabilityEnergyData();

    function getArtistPopularityData() {
		$('.spinner-background').removeClass('d-none');
		var formData = getPopularityFormData();
        
		$.ajax({
			url: '{{ url("api/artists-popularity") }}',          	
          	type: "POST",
          	data: formData,
			processData: false,
			contentType: false,
          	success: function(response) {
                createChartArtistsPopularity(response);

				$('.spinner-background').addClass('d-none');
		  	},
		  	error: function (xhr, ajaxOptions, thrownError) {
		  		console.log(xhr.status);
		  		console.log(thrownError);

				$('.spinner-background').addClass('d-none');
		  	}
        });
	}

    function createChartArtistsPopularity(data) {

        let chart = document.getElementById("chart-artists-popularity");

        adjustChartHeight(chart);

        if (chartArtistsPopularity) {
            chartArtistsPopularity.destroy();
        }

        chartArtistsPopularity = new Chart(chart, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Popularidade',
                        data: data.datasets,
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Popularidade',
                        },
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Entidade',
                        },
                    },
                },
            },
        });
    }

    function getPopularityFormData () {        
		const formData = new FormData()

		formData.append('entity', $('#filter-popularity-entity').val())
		formData.append('limit', $('#filter-popularity-limit').val())
		
		return formData
	}

    function getYearPopularityData() {
        $('.spinner-background').removeClass('d-none');
        var formData = ''
        
        $.ajax({
            url: '{{ url("api/year-popularity") }}',          	
            type: "GET",
            processData: false,
            contentType: false,
            success: function(response) {
                createChartYearPopularity(response);

                $('.spinner-background').addClass('d-none');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);

                $('.spinner-background').addClass('d-none');
            }
        });
    }

    function createChartYearPopularity(data) {
        let chart = document.getElementById("chart-year-popularity");

        adjustChartHeight(chart);

        if (chartYearPopularity) {
            chartYearPopularity.destroy();
        }

        const years = data.map(item => item.year);
        const popularity = data.map(item => item.avg_popularity);

        chartYearPopularity = new Chart(chart, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                    label: 'Popularidade Média',
                    data: popularity,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Popularidade',
                        },
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Ano',
                        },
                    },
                },
            },
        });
    }

    function getDecadePopularityData() {
        $('.spinner-background').removeClass('d-none');
        var formData = ''
        
        $.ajax({
            url: '{{ url("api/decade-popularity") }}',          	
            type: "GET",
            processData: false,
            contentType: false,
            success: function(response) {
                createChartDecadePopularity(response);

                $('.spinner-background').addClass('d-none');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);

                $('.spinner-background').addClass('d-none');
            }
        });
    }

    function createChartDecadePopularity(data) {
        let chart = document.getElementById("chart-decade-popularity");

        adjustChartHeight(chart);

        if (chartDecadePopularity) {
            chartDecadePopularity.destroy();
        }

        const decades = data.map(item => item.decade);
        const popularity = data.map(item => item.avg_popularity);

        chartDecadePopularity = new Chart(chart, {
            type: 'bar',
            data: {
                labels: decades,
                datasets: [{
                    label: 'Popularidade Média',
                    data: popularity,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Popularidade',
                        },
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Decada',
                        },
                    },
                },
            },
        });
    }

    function getCorrelationPopularityData() {
        $('.spinner-background').removeClass('d-none');
        var formData = ''
        
        $.ajax({
            url: '{{ url("api/correlation") }}',          	
            type: "GET",
            processData: false,
            contentType: false,
            success: function(response) {
                createChartCorrelationPopularity(response);

                $('.spinner-background').addClass('d-none');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);

                $('.spinner-background').addClass('d-none');
            }
        });
    }

    function createChartCorrelationPopularity(data) {
        let chart = document.getElementById("popularityChart");

        adjustChartHeight(chart);

        if (chartCorrelationPopularity) {
            chartCorrelationPopularity.destroy();
        }

        const energy = [];
        const danceability = [];
        const valence = [];
        const acousticness = [];
        const tempo = [];
        const popularity = [];

        // Organizando os dados para o gráfico
        data.musics.forEach(function(music) {
            energy.push(music.energy);
            danceability.push(music.danceability);
            valence.push(music.valence);
            acousticness.push(music.acousticness);
            tempo.push(music.tempo);
            popularity.push(music.popularity);
        });

        // Exibindo os coeficientes da regressão
        const coefficients = data.coefficients;
        const regressionList = $('#regressionCoefficients');
        regressionList.empty();
        regressionList.append('<li>Intercepto: ' + data.intercept + '</li>');
        regressionList.append('<li>Energia: ' + coefficients[0] + '</li>');
        regressionList.append('<li>Dançabilidade: ' + coefficients[1] + '</li>');
        regressionList.append('<li>Positividade: ' + coefficients[2] + '</li>');
        regressionList.append('<li>Acústico: ' + coefficients[3] + '</li>');
        regressionList.append('<li>Duração: ' + coefficients[4] + '</li>');

        chartCorrelationPopularity = new Chart(chart, {
            type: 'scatter',
            data: {
                datasets: [
                    {
                        label: 'Energia',
                        data: energy.map((e, i) => ({x: e, y: popularity[i]})),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Dançabilidade',
                        data: danceability.map((e, i) => ({x: e, y: popularity[i]})),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Positividade',
                        data: valence.map((e, i) => ({x: e, y: popularity[i]})),
                        backgroundColor: 'rgba(255, 98, 0, 0.3)',
                        borderColor: 'rgba(255, 98, 0, 0.5)',
                        borderWidth: 1
                    },
                    {
                        label: 'Acústico',
                        data: acousticness.map((e, i) => ({x: e, y: popularity[i]})),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Duração (ms)',
                        data: tempo.map((e, i) => ({x: e, y: popularity[i]})),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Atributo Musical'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Popularidade'
                        }
                    }
                }
            }
        });
    }

    function getDanceabilityEnergyData() {
        $('.spinner-background').removeClass('d-none');

        $.ajax({
            url: '{{ url("api/music-stats") }}',          	
            type: "POST",
            data: getEnergyFormData(),
            processData: false,
            contentType: false,
            success: function(response) {
                createChartDanceabilityEnergy(response);

                $('.spinner-background').addClass('d-none');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);

                $('.spinner-background').addClass('d-none');
            }
        });
    }

    function createChartDanceabilityEnergy(response) {
        let chart = document.getElementById("chart-energy-danceability");
        let chartAlbum = document.getElementById("chart-album-energy");

        adjustChartHeight(chart);
        adjustChartHeight(chartAlbum);

        if (chartDanceabilityEnergy) {
            chartDanceabilityEnergy.destroy();
        }

        if (chartAlbumEnergy) {
            chartAlbumEnergy.destroy();
        }
        
        let years = [];
        let avgEnergy = [];
        let avgDanceability = [];
        
        response.yearStats.forEach(function(data) {
            years.push(data.year);
            avgEnergy.push(data.avg_energy);
            avgDanceability.push(data.avg_danceability);
        });
        
        let albums = [];
        let avgAlbumEnergy = [];
        
        response.albumStats.forEach(function(data) {
            albums.push(data.album);
            avgAlbumEnergy.push(data.avg_energy);
        });


        chartDanceabilityEnergy = new Chart(chart, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                    label: 'Média de Energia (Ano)',
                    data: avgEnergy,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                },
                {
                    label: 'Média de Dançabilidade (Ano)',
                    data: avgDanceability,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valor Médio'
                        }
                    }
                }
            }
        });

        chartAlbumEnergy = new Chart(chartAlbum, {
            type: 'bar',
            data: {
                labels: albums,
                datasets: [{
                    label: 'Média de Energia por Álbum',
                    data: avgAlbumEnergy,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Energia Média'
                        }
                    }
                }
            }
        });
    }

    function getEnergyFormData () {        
		const formData = new FormData()

		formData.append('limit', $('#filter-energy-limit').val())
		
		return formData
	}

    $('#filter-popularity-entity, #filter-popularity-limit').on('change', function() {
        getArtistPopularityData();
    }).trigger('change');

    $('#filter-energy-limit').on('change', function() {
        getDanceabilityEnergyData();

        $('html, body').animate({
            scrollTop: $(document).height()
        }, 100);

    });

    function adjustChartHeight(chart) {
        const canvas = chart;
        const windowWidth = $(window).width();
        let chartHeight = 150;

        if (windowWidth <= 768) {
            chartHeight = 500;
        }
       
        canvas.height = chartHeight;
    }
   
});
</script>
@endsection