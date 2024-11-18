@extends('layouts.common.public')

@section('content')
<div class="row bg-primary mb-2">
    <div class="col-md-12 d-flex justify-content-center text-center">
        <span class="text-white h3 p-3">Dashboard Classic Metal</span>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Artistas/bandas são as mais populares</h4>
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
    getAppointmentData();

    const data = {
        labels: ['Metallica', 'Iron Maiden', 'Led Zeppelin', 'Black Sabbath', 'AC/DC'],
        datasets: [
            {
                label: 'Popularidade (%)',
                data: [95, 90, 85, 80, 75],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1,
            },
        ],
    };

    function getAppointmentData() {
		$('.spinner-background').removeClass('d-none');
		var formData = ''
        
		$.ajax({
			url: '{{ url("api/dashboard") }}',          	
          	type: "POST",
          	data: formData,
			processData: false,
			contentType: false,
          	success: function(response) {
                console.log(response[0].track);

				$('.spinner-background').addClass('d-none');
		  	},
		  	error: function (xhr, ajaxOptions, thrownError) {
		  		console.log(xhr.status);
		  		console.log(thrownError);

				$('.spinner-background').addClass('d-none');
		  	}
        });
	}

    createChartArtistsPopularity(data);

    function createChartArtistsPopularity(data) {
        if (chartArtistsPopularity) {
            chartArtistsPopularity.destroy();
        }

        chartArtistsPopularity = new Chart(document.getElementById("chart-artists-popularity"), {
            type: 'bar',
            data: data,
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
                            text: 'Popularidade (%)',
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
   
   /* if (chartArtistsPopularity2) {
       chartArtistsPopularity2.destroy();
   }

   chartArtistsPopularity2 = new Chart(document.getElementById("chart-artists-popularity-2"), {
       type: 'bar',
       data: data,
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
                       text: 'Popularidade (%)',
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
   }); */
});
</script>
@endsection