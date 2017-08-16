<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{!!asset('public/assets/frontend/')!!}/js/jquery-2.1.1.js" type="text/javascript"></script>
    <script src="{!!asset('/public/assets/frontend/js/Chart.js') !!}"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Visitor', 'Pageviews'],
          @foreach($data as  $value)
          ['{!! $value['date'] !!}',  {!!$value['visitors']!!},  {!!$value['pageviews']!!}],
          @endforeach
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('myChart'));

        chart.draw(data, options);
      }
    </script>
    <script>
        $(document).ready(function(){
            var ctx = document.getElementById('myChart');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data:{
                    labels: [
                         @foreach($data as  $value)
                            '{!! $value['date'] !!}',
                         @endforeach
                    ],
                    datasets:[
                        {
                            label: "Visitors",
                            borderColor: '#e84343',
                            data: [
                                @foreach($data as  $value)
                                   '{!! $value['visitors'] !!}',
                                @endforeach
                            ],
                            fill: false,
                        },
                        {
                            label: "Page Views",
                            borderColor: '#1515ed',
                            data: [
                                @foreach($data as  $value)
                                   '{!! $value['pageviews'] !!}',
                                @endforeach
                            ],
                            fill: false,
                        }
                    ]

                },
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Report '
                    },
                }
            });
        })
    </script>
    <title>Document</title>
</head>
<body>
    {{-- <div id="myChart" width="900"  height="400"></div> --}}
    <div style="width:900px; height:500px; position:relative">
        <canvas id="myChart" width="900" height="400"></canvas>    
    </div>

</body>
</html>
