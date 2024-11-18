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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-between">
                                <h4>Entidades mais populares</h4>
                                <div class="filter col-lg-5 d-flex justify-content-between">
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
                    <div class="col-lg-4 d-flex align-items-center">
                        <div>
                            <h5>Descrição do Gráfico</h5>
                            <p>
                                Este gráfico apresenta as entidades mais populares com base em critérios específicos. 
                                Você pode filtrar as entidades desejadas usando os seletores acima e ajustar a quantidade 
                                de resultados exibidos. Use essas opções para explorar os dados e entender melhor 
                                as tendências de popularidade.
                            </p>
                            <p>
                                Alterne entre diferentes quantidades para analisar mais profundamente os resultados e obter 
                                insights sobre as entidades mais relevantes dentro do escopo selecionado.
                            </p>
                        </div>
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Popularidade média por ano</h4>
                            </div>
                            <div class="col-lg-12 graph-canvas">
                                <canvas class="ms-1 me-1" id="chart-year-popularity"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center">
                        <div>
                            <h5>Descrição do Gráfico</h5>
                            <p>
                                Este gráfico exibe a popularidade média ao longo dos anos, permitindo a análise 
                                de tendências históricas e o desempenho de entidades em diferentes períodos.
                            </p>
                            <p>
                                Através deste gráfico, é possível identificar padrões sazonais, anos de maior destaque 
                                e entender a evolução temporal da popularidade.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Popularidade média por década</h4>
                            </div>
                            <div class="col-lg-12 graph-canvas">
                                <canvas class="ms-1 me-1" id="chart-decade-popularity"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center">
                        <div>
                            <h5>Descrição do Gráfico</h5>
                            <p class="text-small">
                                Este gráfico apresenta a popularidade média ao longo das décadas, permitindo uma análise 
                                de tendências de longo prazo. Ele ajuda a compreender como a relevância de determinadas 
                                entidades ou eventos evoluiu ao longo do tempo.
                            </p>
                            <p class="text-small">
                                Use este gráfico para identificar décadas de maior destaque e avaliar mudanças de 
                                comportamento ou preferências em diferentes períodos históricos.
                            </p>
                        </div>
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
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Correlação entre Popularidade e Características Musicais</h4>
                            </div>
                            <div class="col-lg-12 graph-canvas">
                                <canvas class="ms-1 me-1" id="popularityChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 align-items-center">
                        <div>
                            <h5>Descrição do Gráfico</h5>
                            <p>
                                Este gráfico explora a relação entre a popularidade de músicas e suas características musicais, 
                                como ritmo, energia, dança e outros aspectos técnicos. Ele permite identificar padrões que tornam 
                                músicas mais atraentes ao público.
                            </p>
                            <p>
                                Utilize este gráfico para avaliar quais características influenciam mais diretamente na popularidade 
                                de diferentes faixas, ajudando na análise e na criação de estratégias musicais.
                            </p>
                            <p>
                                Selecionando as variáveis no topo do gráfico, é possível visualizá-las individualmente.
                            </p>
                        </div>
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
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Variação da energia e dançabilidade</h4>
                            </div>
                            <div class="col-lg-12 graph-canvas">
                                <canvas class="ms-1 me-1" id="chart-energy-danceability"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center">
                        <div>
                            <h5>Descrição do Gráfico</h5>
                            <p>
                                Este gráfico analisa a variação de energia e dançabilidade em músicas, 
                                mostrando como essas características mudam ao longo do tempo ou entre diferentes faixas. 
                                Ele é útil para compreender o impacto desses aspectos na experiência auditiva.
                            </p>
                            <p>
                                Use este gráfico para identificar padrões em estilos musicais, como músicas mais enérgicas 
                                ou dançantes, e compreender a relação entre esses atributos e a recepção do público.
                            </p>
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
                    <div class="col-lg-9">
                        <div class="row">
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
                    <div class="col-lg-3 d-flex align-items-center">
                        <div>
                            <h5>Descrição do Gráfico</h5>
                            <p>
                                Este gráfico apresenta a média de energia das faixas em cada álbum, destacando quais 
                                álbuns possuem um estilo mais enérgico. Ele auxilia na análise de padrões de energia em diferentes trabalhos musicais.
                            </p>
                            <p>
                                A seleção de quantidade permite limitar a visualização para focar nos álbuns mais ou menos energéticos, 
                                dependendo da análise desejada.
                            </p>
                        </div>
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
                    <div class="col-lg-6">
                        <div class="graph-canvas">
                            <div class="col-lg-12">
                                <h4>Distribuição de assinaturas de tempo</h4>
                            </div>
                            <canvas id="timeSignaturesChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="graph-canvas">
                            <div class="col-lg-12">
                                <h4>Distribuição de assinaturas de tempo por popularidade</h4>
                            </div>
                            <canvas id="popularityComparisonChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div>
                            <h5>Descrição dos Gráficos</h5>
                            <p>
                                O primeiro gráfico, "Distribuição de assinaturas de tempo", exibe a frequência de diferentes assinaturas de tempo nas faixas, destacando padrões rítmicos mais comuns, como 4/4, 3/4, entre outros.
                            </p>
                            <p>
                                O segundo gráfico, "Distribuição de assinaturas de tempo por popularidade", compara a popularidade das músicas com suas assinaturas de tempo, permitindo identificar quais métricas rítmicas estão associadas a maior sucesso.
                            </p>
                            <p>
                                Ambos os gráficos fornecem uma visão detalhada das preferências rítmicas e de como a estrutura de tempo influencia o sucesso das músicas em diferentes contextos.
                            </p>
                        </div>
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
                    <div class="col-lg-8 d-flex">
                        <div class="col-lg-3">
                            <div class="graph-canvas">
                                <div class="col-lg-12">
                                    <h4>Distribuição por tonalidades</h4>
                                </div>
                                <canvas id="modesChart"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="graph-canvas">
                                <div class="col-lg-12">
                                    <h4>Distribuição por "notas"</h4>
                                </div>
                                <canvas id="keysChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12 d-flex align-items-center">
                            <div>
                                <h5>Descrição dos Gráficos</h5>
                                <p>
                                    O primeiro gráfico, "Distribuição por tonalidades", exibe a frequência de tonalidades musicais utilizadas nas faixas. Ele ajuda a entender como as tonalidades influenciam a harmonia e a tonalidade das músicas.
                                </p>
                                <p>
                                    O segundo gráfico, "Distribuição por 'notas'", mostra a frequência das notas utilizadas nas faixas. Isso permite observar as escolhas de notas e como elas impactam a estrutura melódica.
                                </p>
                                <p>
                                    Ambos os gráficos oferecem uma visão interessante sobre como as tonalidades e notas são distribuídas nas músicas, revelando padrões que podem estar relacionados a estilos musicais específicos ou influências culturais.
                                </p>
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
var chartMusicTones = null;
var chartMusicTones2 = null;
var chartMusicTones3 = null;
var chartMusicTones4 = null;

jQuery(document).ready(function ($) {
    getArtistPopularityData();
    getYearPopularityData();
    getDecadePopularityData();
    getCorrelationPopularityData();
    getDanceabilityEnergyData();
    getMusicTonesData();

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

    function getMusicTonesData() {
        $('.spinner-background').removeClass('d-none');
        
        $.ajax({
            url: '{{ url("api/music-tones") }}',          	
            type: "GET",
            processData: false,
            contentType: false,
            success: function(response) {
                createChartMusicTones(response);
                createChartMusicTones2(response);
                createChartMusicTones3(response);
                createChartMusicTones4(response);

                $('.spinner-background').addClass('d-none');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);

                $('.spinner-background').addClass('d-none');
            }
        });
    }

    function createChartMusicTones(data) {

        let chart = document.getElementById('timeSignaturesChart');

        adjustChartHeight(chart);

        if (chartMusicTones) {
            chartMusicTones.destroy();
        }

        chartMusicTones = new Chart(chart, {
            type: 'bar',
            data: {
                labels: Object.keys(data.timeSignatures),
                datasets: [{
                    label: 'Distribuição de Assinaturas de Tempo',
                    data: Object.values(data.timeSignatures),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function createChartMusicTones2(data) {
        let chart = document.getElementById('modesChart');

        adjustChartHeight(chart);

        if (chartMusicTones2) {
            chartMusicTones2.destroy();
        }

        chartMusicTones2 = new Chart(chart, {
            type: 'pie',
            data: {
                labels: ['Menor', 'Maior'],
                datasets: [{
                    label: 'Modos',
                    data: [data.modes[0] || 0, data.modes[1] || 0],
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });
    }

    function createChartMusicTones3(data) {

        let chart = document.getElementById('keysChart');

        adjustChartHeight(chart);

        if (chartMusicTones3) {
            chartMusicTones3.destroy();
        }

        chartMusicTones3 = new Chart(chart, {
            type: 'bar',
            data: {
                labels: Object.keys(data.keys),
                datasets: [{
                    label: 'Tonalidades',
                    data: Object.values(data.keys),
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });
    }

    function createChartMusicTones4(data) {

        const chart = document.getElementById('popularityComparisonChart');

        adjustChartHeight(chart);

        if (chartMusicTones4) {
            chartMusicTones4.destroy();
        }

        chartMusicTones4 = new Chart(chart, {
            type: 'bar',
            data: {
                labels: Object.keys(data.popularTimeSignatures),
                datasets: [
                    {
                        label: 'Populares',
                        data: Object.values(data.popularTimeSignatures),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Menos Populares',
                        data: Object.values(data.lessPopularTimeSignatures),
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
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