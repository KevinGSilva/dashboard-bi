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
                        <h4>Artistas/bandas são as mais populares</h4>
                        <div class="filter col-lg-4 d-flex justify-content-between">
                            <div class="col-lg-5">
                                <label for="entity">Visualização</label>
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
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Artistas/bandas são as mais populares</h4>
                    </div>
                    <div class="col-lg-12 graph-canvas">
                        <canvas class="ms-1 me-1" id="chart-artists-popularity-2"></canvas>
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
var chartArtistsPopularity2 = null;

jQuery(document).ready(function ($) {
    getArtistPopularityData();

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
            chartArtistsPopularity.destroy(); // Remove o gráfico anterior, se existir
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
                            text: 'Artistas/Bandas',
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

    $('#filter-popularity-entity, #filter-popularity-limit').on('change', function() {
        getArtistPopularityData();
    }).trigger('change');

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