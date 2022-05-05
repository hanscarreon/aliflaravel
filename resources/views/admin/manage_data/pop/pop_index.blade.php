@extends('home')

@section('title')
    Pcvl
@endsection

@section('extra-css')
    <style>
        .btn-primary {
            margin: 0%;
        }

        /* The side navigation menu */
        .sidenav {
            height: 100%;
            /* 100% Full-height */
            width: 0;
            /* 0 width - change this with JavaScript */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Stay on top */
            top: 0;
            /* Stay at the top */
            right: 0;
            background-color: rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            /* Black*/
            overflow-x: hidden;
            /* Disable horizontal scroll */
            padding-top: 120px;
            /* Place content 60px from the top */
            transition: 0.5s;
            /* 0.5 second transition effect to slide in the sidenav */
        }

        /* The navigation menu links */
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #000;
            display: block;
            transition: 0.3s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
            color: #818181;
        }

        /* Position and style the close button (top right corner) */
        .sidenav .closebtn {
            position: absolute;
            padding-top: 60px;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        #box {
            display: none;
            background-color: salmon;
            color: white;
            width: 100px;
            height: 100px;
        }

    </style>
@endsection

@section('index')
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="row">
                    <!-- PIE CHART -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Barangay Chart</h2>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">List of date added data</h2>
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
                            <a class="nav-link active" href="{{ route('popViewAll') }}">POP Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('encodedViewAll') }}">Encoded</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tallying</a>
                        </li>
                    </ul>



                    <div class="card-body">

                        <div class="row w-100">
                            <div class="col-6">
                                <h4>Number of Voters (POP) </h4>
                            </div>
                            <div class="col-6 ">
                                <span onclick="openNav()" class="btn btn-primary float-right" id="button-addon1"><i
                                        class="nc-icon nc-tile-56"></i></span>
                            </div>
                        </div>

                        <!-- Search  -->
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <div class="container mb-4">
                                <div id="precinct-form" class="panel">
                                    <form action="{{ route('submitFilterPop') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="Precinct Number">Precinct Number</label>
                                            <input type="text" class="form-control" aria-label="Precinct Number"
                                                aria-describedby="button-addon2" name="filterPrecinct">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="Precinct Number">Name and Address of Voting Center</label>
                                            <input type="text" class="form-control" name="filterNameAndAddress"
                                                value="{{ old('filterNameAndAddress') }}">
                                        </div>
                                        <div class="form-group mb-5">
                                            <label for="exampleFormControlSelect1">Search by Barangay</label>
                                            <select class="form-control"
                                                name="selectBarangay">
                                                <option disabled selected>Select Barangay</option>
                                                @foreach ($barangay as $item)
                                                    <option value="{{ $item->barangay }}">
                                                        {{ $item->barangay}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- End Search  -->

                        {{-- {{$pcvlData}} --}}
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barangay</th>
                                        <th>NAME AND ADDRESS
                                            OF VOTING CENTER</th>
                                        <th>ESTABLISHED
                                            PRECINCT
                                            NUMBER</th>
                                        <th>TOTAL NO.OF REG
                                            VOTERS AFTER
                                            CLUSTERING/
                                            GROUPING</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($popData as $row)
                                        <tr>
                                            <td>{{ $row->popBarangay }}</td>
                                            <td>{{ $row->popNameAddress }}</td>
                                            <td>{{ $row->popPrecinctNumber }}</td>
                                            <td>{{ $row->popRegisteredVoters }}</td>
                                            {{-- <td class="text-center">
                                                <a href="#" class="btn btn-warning btn-sm disabled">Edit</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-left">{{ $popData->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
    <script>
        

        $(function() {
            // BAR CHART DATA
            var dateData = `{{ $dbtable }}`
            var parse = JSON.parse(dateData.replace(/&quot;/g, '"'));
            // const stringify = JSON.stringify(parse);
            console.log(parse);


            var ict_unit = [];
            var efficiency = [];
            var coloR = [];

            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };

            for (var i in parse) {
                ict_unit.push("ICT Unit " + parse[i].ict_unit);
                efficiency.push(parse[i].efficiency);
                coloR.push(dynamicColors());
            }
            var areaChartData = {
                labels: parse.map(date => {
                    dateValue = date['new_date']
                    return dateValue
                }),
                datasets: [{
                    backgroundColor: coloR,
                    borderColor: coloR,
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: coloR,
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: coloR,
                    data: parse.map(date => {
                        dateValue = date['data']
                        return dateValue
                    })
                }, ]
            }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                legend: {
                    display: false,
                }
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        });




        // PIE CHART DATA

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var munis = `{{ $barangay }}`
        var parse = JSON.parse(munis.replace(/&quot;/g, '"'));
        console.log(parse);

        var ict_unit = [];
        var efficiency = [];
        var coloR = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in parse) {
            ict_unit.push("ICT Unit " + parse[i].ict_unit);
            efficiency.push(parse[i].efficiency);
            coloR.push(dynamicColors());
        }
        var donutData = {
            labels: parse.map(muni => {
                muniValue = muni['barangay']
                return muniValue
            }),
            datasets: [{
                data: parse.map(muni => {
                    muniValue = muni['total']
                    return muniValue
                }),
                backgroundColor: coloR,
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
    </script>
@endsection
