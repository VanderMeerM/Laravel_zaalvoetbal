@extends( 'CSS.app')

 <script src="https://cdn.tailwindcss.com"></script> 
 <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


<x-header>    </x-header>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 Highcharts Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <h3 class="card-header p-3">Laravel 12 Highcharts Example</h3>
            <div class="card-body">
                <div id="chart-container"></div>
            </div>
        </div>
    </div>

    <script>
        Highcharts.chart('chart-container', {
            title: {
                text: 'User Growth, {{ date('Y') }}'
            },
            subtitle: {
              //  text: 'Source: Your Laravel App'
            },
            xAxis: {
                //categories: @json($months),
                data: $userData,
                title: {
                    text: 'Spelers'
                }
            },
            yAxis: {
                title: {
                    text: 'Percentage'
                },
                min: 0
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            series: [{
                name: 'New Users',
                data: @json($userData)
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
</body>
</html>

