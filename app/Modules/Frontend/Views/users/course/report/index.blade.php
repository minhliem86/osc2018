@extends('Frontend::layouts.layout')

@section('title', 'ILA Du Học Hè 2017 - Thư viện hình ảnh')
@section('css')
  <link rel="stylesheet" href="{!!asset('public/assets/frontend/')!!}/css/customer.min.css">
@stop

@section('script')
    <script src="{!!asset('/public/assets/frontend/js/Chart.js') !!}"></script>
    <script>
        $(document).ready(function(){
            var ctx = document.getElementById('mychart');
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
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    title:{
                        display:true,
                        text:'Report Pageviews & Visitors ',
                    },
                }
            });
        })
    </script>
@stop

@section('content')
    @include('Frontend::layouts.banner')

    <section class="chart">
        <div class="container">
            <div class="row">
                <div class="wrap-chart">
                    <div class="wrap-control">

                    </div>
                    <div class="chart-area">
                        <canvas id="mychart"></canvas>
                    </div>
                </div>    <!-- end wrap-chart -->
            </div>
        </div>
    </section>
@stop
