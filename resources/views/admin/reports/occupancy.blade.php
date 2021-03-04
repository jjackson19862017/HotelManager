<x-admin-master>

@section('scripts')
    <!-- Graphs -->
    @endsection

    @section('content')
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-4 w-100">
                        @if(count($CurrentYearArray)!=0 || count($BackOneYearRoomsSold)!=0 || count($BackTwoYearRoomsSold)!=0)

                            <div class="card vh-33">
                                <div class="card-header text-center">
                                    {{$hotel->name}} - Three Year Monthly Occupancy Report
                                </div>
                                <div class="card-body p-1">
                                    <canvas id="monthlyBreakdownChart" width="100%" height="30"></canvas>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-sm">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>Year</th>
                            @foreach($months as $month)
                                <th>{{$month}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @if(count($CurrentYearArray)!=0)
                            <tr>
                                <td rowspan="2" class="align-middle">{{$currentYear}}</td>
                                @foreach ($CurrentYearArraySold as $item)
                                    <td>{{$item}}</td>
                                @endforeach
                                <td>{{$CurrentYearTotal}}</td>
                            </tr>
                            <tr>
                                @foreach ($CurrentYearOcc as $item)
                                    <td>{{$item}}%</td>
                                @endforeach
                                <td>{{$CurrentYearAvg}}</td>

                            </tr>
                        @else
                        @endif

                        @if(count($BackOneYearArray)!=0)
                            <tr>
                                <td rowspan="2" class="align-middle">{{$backOneYear}}</td>
                                @foreach ($BackOneYearArraySold as $item)
                                    <td>{{$item}}</td>
                                @endforeach
                                <td>{{$BackOneYearTotal}}</td>
                            </tr>
                            <tr>
                                @foreach ($BackOneYearOcc as $item)
                                    <td>{{$item}}%</td>
                                @endforeach
                                <td>{{$BackOneYearAvg}}%</td>
                            </tr>
                        @else
                        @endif


                        @if(count($BackTwoYearArray)!=0)
                            <tr>
                                <td rowspan="2" class="align-middle">{{$backTwoYear}}</td>
                                @foreach ($BackTwoYearArraySold as $item)
                                    <td>{{$item}}</td>
                                @endforeach
                                <td>{{$BackTwoYearTotal}}</td>
                            </tr>
                            <tr>
                                @foreach ($BackTwoYearOcc as $item)
                                    <td>{{$item}}%</td>
                                @endforeach
                                <td>{{$BackTwoYearAvg}}%</td>
                            </tr>
                        @else
                        @endif
                        </tbody>
                    </table>
                    @else
                        <h1>No Data</h1>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script src="{{asset('vendor/chart.js/Chart.js')}}"></script>

        <script>

            <!-- Bottom Chart -->
            var ctx = document.getElementById('monthlyBreakdownChart');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach($months as $item)
                            '{{$item}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: {{$backTwoYear}},
                        data: [
                            @foreach($BackTwoYearOcc as $item)
                            {{$item}},
                            @endforeach
                        ],

                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)'

                        ],
                        borderWidth: 1
                    }
                        ,
                        {
                            label: {{$backOneYear}},
                            data: [
                                @foreach($BackOneYearOcc as $item)
                                {{$item}},
                                @endforeach],

                            backgroundColor: [
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)',
                                'rgba(41, 48, 232, 0.2)'


                            ],
                            borderColor: [
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)',
                                'rgba(41, 48, 232, 1)'

                            ],
                            borderWidth: 1
                        }, {
                            label: {{$currentYear}},
                            data: [

                                @foreach($CurrentYearOcc as $item)
                                {{$item}},
                                @endforeach],

                            backgroundColor: [
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)',
                                'rgba(0, 204, 102, 0.2)'

                            ],
                            borderColor: [
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)',
                                'rgba(0, 204, 102, 1)'

                            ],
                            borderWidth: 1
                        }


                    ]
                },
                options: {
                    legend: {
                        display: true,
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                max: 100,
                                beginAtZero: true,
                            }
                        }]
                    }
                }
            });
        </script>

    @endsection

</x-admin-master>
