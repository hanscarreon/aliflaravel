@extends('home')

@section('title')
    Pcvl
@endsection

@section('extra-css')
    <style>
        .btn-primary {
            margin: 0%;
        }

        .pagination{
            padding-left: 0%;
        }

    </style>
@endsection

@section('index')
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="row">
                    <!-- PIE CHART -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Precinct Chart</h2>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- BAR CHART -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Municipality Chart</h2>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <div class="card">
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pcvlViewAll') }}">PCVL
                                Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('popViewAll') }}">POP Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('encodedViewAll') }}">Encoded</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tallying</a>
                        </li>
                    </ul>

                    <div class="card-body">
                        <div class="">
                            {{-- <a href="{{ route('manage-voters.create') }}" class="btn btn-success btn-sm">Add New</a> --}}
                        </div>
                        <form action="{{ route('submitFilterPcvl') }}" method="POST">
                            @csrf
                            <div class="row w-100">
                                <div class="col-6">
                                    <h4>Number of Voters (POP) </h4>

                                </div>
                                {{-- <div class="col-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Voters Name"
                                            aria-label="Voters Name" aria-describedby="button-addon2"
                                            name="pcvlVotersFullName">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="button-addon2"><i
                                                    class="nc-icon nc-zoom-split"></i> Search</button>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </form>

                        {{-- {{$pcvlData}} --}}
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Middle Name</th>
                                        <th>Barangay</th>
                                        <th>Province</th>
                                        <th>Municipality</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encodedData as $row)
                                        <tr>
                                            <td class="text-center">{{ ++$loop->index }}</td>
                                            <td>{{ $row->firstname }}</td>
                                            <td>{{ $row->lastname }}</td>
                                            <td>{{ $row->middlename }}</td>
                                            <td>{{ $row->barangay_description }}</td>
                                            <td>{{ $row->province_description }}</td>
                                            <td>{{ $row->city_municipality_description }}</td>

                                            {{-- <td class="text-center">
                                        <a href="#" class="btn btn-warning btn-sm disabled">Edit</a>
                                    </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class="float-md-left position-static" style="">{{ $encodedData->links() }}</div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
    <script>
        $(function() {
            // BAR CHART DATA

            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: 'Electronics',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                ]
            }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        })




        // PIE CHART DATA

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutData = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [{
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
        var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    </script>
@endsection
