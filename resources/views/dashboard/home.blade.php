@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('lang.statistics-and-reports') }}
@endsection

@section('content')
    @if (Auth::user()->isClientSupervisor())
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card w_data_1">
                    <div class="body">
                        <div class="w_icon cyan"><i class="zmdi ti-user"></i></div>
                        <h4 class="mt-3 mb-0">{{ $totalRegisteredEmployee }}</h4>
                        <span class="text-muted">{{ __('lang.total-of-employee') }}</span>
                        <div class="w_description text-success">
                            <span><a class="btn btn-primary btn-sm waves-effect waves-light"
                                    href="{{ route('view.employees') }}">{{ __('lang.more-details') }} >></a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card w_data_1">
                    <div class="body">
                        <div class="w_icon pink"><i class="zmdi ti-signal"></i></div>
                        <h4 class="mt-3 mb-1">{{ $totalEmployeeNotRegisterBracelets }}/{{ $totalRegisteredEmployee }}</h4>
                        <span class="text-muted">{{ __('lang.employees-rot-register-bracelets') }}</span>
                        <div class="w_description text-success">
                            <span><a class="btn btn-primary btn-sm waves-effect waves-light"
                                    href="{{ route('view.employee_not_register_bracelets') }}">{{ __('lang.more-details') }} >></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card w_data_1">
                    <div class="body">
                        <div class="w_icon cyan"><i class="zmdi ti-check"></i></div>
                        <h4 class="mt-3 mb-1">{{ $totalEmployeeScannedToday }}</h4>
                        <span class="text-muted">{{ __('lang.total-scans-performed-today') }}</span>
                        <div class="w_description text-success">
                            <span><a class="btn btn-primary btn-sm waves-effect waves-light"
                                    href="{{ route('view.employee_scanned_today') }}">{{ __('lang.more-details') }} >></a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card w_data_1">
                    <div class="body">
                        <div class="w_icon gray"><i class="zmdi ti-check"></i></div>
                        <h4 class="mt-3 mb-1">{{ $totalEmployeeScannedYesterday }}</h4>
                        <span class="text-muted">{{ __('lang.total-scans-performed-yesterday') }}</span>
                        <div class="w_description text-success">
                            <span><a class="btn btn-primary btn-sm waves-effect waves-light"
                                    href="{{ route('view.employee_scanned_yesterday') }}">{{ __('lang.more-details') }} >></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.employees-with') }} <span style="color:red;">{{ __('lang.highest') }} </span>{{ __('lang.temperature-today') }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>{{ __('lang.employee-name') }}</th>
                                        <th>{{ __('lang.temperature') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeesHighestTemperatureToday ?? '' as $employeeHighestTemperatureToday)
                                        <tr>
                                            <td>
                                                <a
                                                    href="{{ route('show.employee', $employeeHighestTemperatureToday->user_id) }}">
                                                    {{ $employeeHighestTemperatureToday->name }}
                                                </a>
                                            </td>
                                            <td>{{ $employeeHighestTemperatureToday->temperature }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.employees-with') }} {{ __('lang.lowest') }} {{ __('lang.temperature-today') }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>{{ __('lang.employee-name') }}</th>
                                        <th>{{ __('lang.temperature') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeesLowTemperatureToday ?? '' as $employeeLowTemperatureToday)
                                        <tr>
                                            <td>
                                                <a
                                                    href="{{ route('show.employee', $employeeLowTemperatureToday->user_id) }}">
                                                    {{ $employeeLowTemperatureToday->name }}
                                                </a>
                                            </td>
                                            <td>{{ $employeeLowTemperatureToday->temperature }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.total-of-highest-temperature') }} </strong> / <strong> {{ __('lang.total-of-who-is-got-covid') }} </strong> </h2>
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">{{ __('lang.monthly') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="false">{{ __('lang.weekly') }} ( {{ __('lang.currunt-month') }} )</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="false">{{ __('lang.daily') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                <canvas id="bar_chart_monthly_c" class="chartjs_graph"></canvas>
                            </div>
                            <div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                                <canvas id="bar_chart_weekly_c" class="chartjs_graph"></canvas>
                            </div>

                            <div class="tab-pane fade" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                                <canvas id="bar_chart_daily_c" class="chartjs_graph"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.early-warning-score') }} (EWS) </strong></h2>
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="score0-tab" data-toggle="tab" href="#score0" role="tab" aria-controls="score0" aria-selected="true">0 {{ __('lang.score') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="score1-tab" data-toggle="tab" href="#score1" role="tab" aria-controls="score1" aria-selected="true">1 {{ __('lang.score') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="score2-tab" data-toggle="tab" href="#score2" role="tab" aria-controls="score2" aria-selected="true">2 {{ __('lang.score') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="score3-tab" data-toggle="tab" href="#score3" role="tab" aria-controls="score3" aria-selected="true">3 {{ __('lang.score') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="score4-tab" data-toggle="tab" href="#score4" role="tab" aria-controls="score4" aria-selected="true">4 {{ __('lang.score') }}</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="score0" role="tabpanel" aria-labelledby="score0-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('lang.employee-name') }}</th>
                                                <th>{{ __('lang.temperature') }}</th>
                                                <th>{{ __('lang.heart-rate') }}</th>
                                                <th>{{ __('lang.spo2') }}</th>
                                                <th>{{ __('lang.blood-pressure') }}</th>
                                                {{--  <th>{{ __('lang.respiratory-rate') }}</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">John Mark</a>
                                                </td>
                                                <td>36</td>
                                                <td>50</td>
                                                <td>92</td>
                                                <td>70</td>
                                                {{--  <td>2</td>  --}}
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">Kevin James</a>
                                                </td>
                                                <td>37.9</td>
                                                <td>99</td>
                                                <td>91</td>
                                                <td>80</td>
                                                {{--  <td>20</td>  --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="score1" role="tabpanel" aria-labelledby="score1-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('lang.employee-name') }}</th>
                                                <th>{{ __('lang.temperature') }}</th>
                                                <th>{{ __('lang.heart-rate') }}</th>
                                                <th>{{ __('lang.spo2') }}</th>
                                                <th>{{ __('lang.blood-pressure') }}</th>
                                                {{--  <th>{{ __('lang.respiratory-rate') }}</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">John Mark</a>
                                                </td>
                                                <td>37</td>
                                                <td>50</td>
                                                <td>92</td>
                                                <td>70</td>
                                                {{--  <td>2</td>  --}}
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">Kevin James</a>
                                                </td>
                                                <td>38.9</td>
                                                <td>99</td>
                                                <td>91</td>
                                                <td>80</td>
                                                {{--  <td>20</td>  --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="score2" role="tabpanel" aria-labelledby="score2-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('lang.employee-name') }}</th>
                                                <th>{{ __('lang.temperature') }}</th>
                                                <th>{{ __('lang.heart-rate') }}</th>
                                                <th>{{ __('lang.spo2') }}</th>
                                                <th>{{ __('lang.blood-pressure') }}</th>
                                                {{--  <th>{{ __('lang.respiratory-rate') }}</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">John Mark</a>
                                                </td>
                                                <td>36</td>
                                                <td>50</td>
                                                <td>92</td>
                                                <td>70</td>
                                                {{--  <td>2</td>  --}}
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">Kevin James</a>
                                                </td>
                                                <td>37.9</td>
                                                <td>99</td>
                                                <td>91</td>
                                                <td>80</td>
                                                {{--  <td>20</td>  --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="score3" role="tabpanel" aria-labelledby="score3-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('lang.employee-name') }}</th>
                                                <th>{{ __('lang.temperature') }}</th>
                                                <th>{{ __('lang.heart-rate') }}</th>
                                                <th>{{ __('lang.spo2') }}</th>
                                                <th>{{ __('lang.blood-pressure') }}</th>
                                                {{--  <th>{{ __('lang.respiratory-rate') }}</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">Kevin James</a>
                                                </td>
                                                <td>36</td>
                                                <td>50</td>
                                                <td>92</td>
                                                <td>70</td>
                                                {{--  <td>2</td>  --}}
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">John Mark</a>
                                                </td>
                                                <td>37.9</td>
                                                <td>99</td>
                                                <td>91</td>
                                                <td>80</td>
                                                {{--  <td>20</td>  --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="score4" role="tabpanel" aria-labelledby="score4-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('lang.employee-name') }}</th>
                                                <th>{{ __('lang.temperature') }}</th>
                                                <th>{{ __('lang.heart-rate') }}</th>
                                                <th>{{ __('lang.spo2') }}</th>
                                                <th>{{ __('lang.blood-pressure') }}</th>
                                                {{--  <th>{{ __('lang.respiratory-rate') }}</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">John Mark</a>
                                                </td>
                                                <td>36</td>
                                                <td>50</td>
                                                <td>92</td>
                                                <td>70</td>
                                                {{--  <td>2</td>  --}}
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="employees/6">Kevin James</a>
                                                </td>
                                                <td>37.9</td>
                                                <td>99</td>
                                                <td>91</td>
                                                <td>80</td>
                                                {{--  <td>20</td>  --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('js')
            <script>
                /*  clintes dashboard  */
                var bc_m_c = document.getElementById("bar_chart_monthly_c").getContext("2d");
                new Chart(bc_m_c, getChartJsMonthly(bc_m_c, 'bar'));

                var bc_w_c = document.getElementById("bar_chart_weekly_c").getContext("2d");
                new Chart(bc_w_c, getChartJsWeekly(bc_w_c, 'bar'));

                var bc_d_c = document.getElementById("bar_chart_daily_c").getContext("2d");
                new Chart(bc_d_c, getChartJsDaily(bc_d_c, 'bar'));
                function getChartJsMonthly(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.January')  !!}", "{!!  __('lang.February')  !!}", "{!!  __('lang.March')  !!}", "{!!  __('lang.April')  !!}", "{!!  __('lang.May')  !!}", "{!!  __('lang.June')  !!}", "{!!  __('lang.July')  !!}", "{!!  __('lang.August')  !!}", "{!!  __('lang.September')  !!}", "{!!  __('lang.October')  !!}", "{!!  __('lang.November')  !!}", "{!!  __('lang.December')  !!}"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [15,5,10,11],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [5,3,4,3],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsWeekly(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.week')  !!} 1", "{!!  __('lang.week')  !!} 2", "{!!  __('lang.week')  !!} 3", "{!!  __('lang.week')  !!} 4"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [15,5,10,11],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [5,3,4,3],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsDaily(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.Sunday')  !!}-22-11", "{!!  __('lang.Monday')  !!}-23-11", "{!!  __('lang.Tuesday')  !!}-24-11", "{!!  __('lang.Wednesday')  !!}-25-11", "{!!  __('lang.Thursday')  !!}-26-11", "{!!  __('lang.Friday')  !!}-27-11", "{!!  __('lang.Starday')  !!}-28-11"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [15,5,10,11,3,5,7],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [5,2,4,2,1,2,3],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsMonthly(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.January')  !!}", "{!!  __('lang.February')  !!}", "{!!  __('lang.March')  !!}", "{!!  __('lang.April')  !!}", "{!!  __('lang.May')  !!}", "{!!  __('lang.June')  !!}", "{!!  __('lang.July')  !!}", "{!!  __('lang.August')  !!}", "{!!  __('lang.September')  !!}", "{!!  __('lang.October')  !!}", "{!!  __('lang.November')  !!}", "{!!  __('lang.December')  !!}"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [15,5,10,11],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [5,3,4,3],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }
            </script>
        @endsection
    @endif
    @if (Auth::user()->isPTAdmin())
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.total-of-highest-temperature') }} </strong> / <strong> {{ __('lang.total-of-who-is-got-covid') }} </strong> </h2>
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">{{ __('lang.monthly') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="false">{{ __('lang.weekly') }} ( {{ __('lang.currunt-month') }} )</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="false">{{ __('lang.daily') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                <canvas id="bar_chart_monthly" class="chartjs_graph"></canvas>
                            </div>
                            <div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                                <canvas id="bar_chart_weekly" class="chartjs_graph"></canvas>
                            </div>

                            <div class="tab-pane fade" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                                <canvas id="bar_chart_daily" class="chartjs_graph"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Total of Scanned for every client</strong> / <strong>Total of Employyees</strong></h2>
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="scanned-daily-tab" data-toggle="tab" href="#scanned_daily" role="tab" aria-controls="scanned_daily" aria-selected="true">Daily ( Currunt Day )</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="scanned_daily" role="tabpanel" aria-labelledby="scanned-daily-tab">
                                <canvas id="bar_chart_scanned_daily" class="chartjs_graph"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('js')
            <script>
                var bc_m = document.getElementById("bar_chart_monthly").getContext("2d");
                new Chart(bc_m, getChartJsMonthly(bc_m, 'bar'));

                var bc_w = document.getElementById("bar_chart_weekly").getContext("2d");
                new Chart(bc_w, getChartJsWeekly(bc_w, 'bar'));

                var bc_d = document.getElementById("bar_chart_daily").getContext("2d");
                new Chart(bc_d, getChartJsDaily(bc_d, 'bar'));

                var bc_s = document.getElementById("bar_chart_scanned_daily").getContext("2d");
                new Chart(bc_s, getChartJsScannedDaily(bc_s, 'bar'));

                function getChartJsMonthly(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.January')  !!}", "{!!  __('lang.February')  !!}", "{!!  __('lang.March')  !!}", "{!!  __('lang.April')  !!}", "{!!  __('lang.May')  !!}", "{!!  __('lang.June')  !!}", "{!!  __('lang.July')  !!}", "{!!  __('lang.August')  !!}", "{!!  __('lang.September')  !!}", "{!!  __('lang.October')  !!}", "{!!  __('lang.November')  !!}", "{!!  __('lang.December')  !!}"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [{{ $employeesHighestTemperatureMonthly[0] }}, {{ $employeesHighestTemperatureMonthly[1] }}, {{ $employeesHighestTemperatureMonthly[2] }}, {{ $employeesHighestTemperatureMonthly[3] }}, {{ $employeesHighestTemperatureMonthly[4] }},  {{ $employeesHighestTemperatureMonthly[5] }},  {{ $employeesHighestTemperatureMonthly[6] }},  {{ $employeesHighestTemperatureMonthly[7] }},  {{ $employeesHighestTemperatureMonthly[8] }},  {{ $employeesHighestTemperatureMonthly[9] }}, {{ $employeesHighestTemperatureMonthly[10] }}, {{ $employeesHighestTemperatureMonthly[11] }} ],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [{{ $employeesGotCovidMonthly[0] }}, {{ $employeesGotCovidMonthly[1] }}, {{ $employeesGotCovidMonthly[2] }}, {{ $employeesGotCovidMonthly[3] }}, {{ $employeesGotCovidMonthly[4] }},  {{ $employeesGotCovidMonthly[5] }},  {{ $employeesGotCovidMonthly[6] }},  {{ $employeesGotCovidMonthly[7] }},  {{ $employeesGotCovidMonthly[8] }},  {{ $employeesGotCovidMonthly[9] }}, {{ $employeesGotCovidMonthly[10] }}, {{ $employeesGotCovidMonthly[11] }} ],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsWeekly(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.week')  !!} 1", "{!!  __('lang.week')  !!} 2", "{!!  __('lang.week')  !!} 3", "{!!  __('lang.week')  !!} 4"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [15,5,10,11],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [5,3,4,3],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsDaily(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.Sunday')  !!}-22-11", "{!!  __('lang.Monday')  !!}-23-11", "{!!  __('lang.Tuesday')  !!}-24-11", "{!!  __('lang.Wednesday')  !!}-25-11", "{!!  __('lang.Thursday')  !!}-26-11", "{!!  __('lang.Friday')  !!}-27-11", "{!!  __('lang.Starday')  !!}-28-11"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [15,5,10,11,3,5,7],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [5,2,4,2,1,2,3],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsMonthly(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: ["{!!  __('lang.January')  !!}", "{!!  __('lang.February')  !!}", "{!!  __('lang.March')  !!}", "{!!  __('lang.April')  !!}", "{!!  __('lang.May')  !!}", "{!!  __('lang.June')  !!}", "{!!  __('lang.July')  !!}", "{!!  __('lang.August')  !!}", "{!!  __('lang.September')  !!}", "{!!  __('lang.October')  !!}", "{!!  __('lang.November')  !!}", "{!!  __('lang.December')  !!}"],
                                datasets: [{
                                    label: "{!!  __('lang.total-of-highest-temperature')  !!}",
                                    data: [{{ $employeesHighestTemperatureMonthly[0] }}, {{ $employeesHighestTemperatureMonthly[1] }}, {{ $employeesHighestTemperatureMonthly[2] }}, {{ $employeesHighestTemperatureMonthly[3] }}, {{ $employeesHighestTemperatureMonthly[4] }},  {{ $employeesHighestTemperatureMonthly[5] }},  {{ $employeesHighestTemperatureMonthly[6] }},  {{ $employeesHighestTemperatureMonthly[7] }},  {{ $employeesHighestTemperatureMonthly[8] }},  {{ $employeesHighestTemperatureMonthly[9] }}, {{ $employeesHighestTemperatureMonthly[10] }}, {{ $employeesHighestTemperatureMonthly[11] }} ],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "{!!  __('lang.total-of-who-is-got-covid')  !!}",
                                    data: [{{ $employeesGotCovidMonthly[0] }}, {{ $employeesGotCovidMonthly[1] }}, {{ $employeesGotCovidMonthly[2] }}, {{ $employeesGotCovidMonthly[3] }}, {{ $employeesGotCovidMonthly[4] }},  {{ $employeesGotCovidMonthly[5] }},  {{ $employeesGotCovidMonthly[6] }},  {{ $employeesGotCovidMonthly[7] }},  {{ $employeesGotCovidMonthly[8] }},  {{ $employeesGotCovidMonthly[9] }}, {{ $employeesGotCovidMonthly[10] }}, {{ $employeesGotCovidMonthly[11] }} ],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

                function getChartJsScannedDaily(obj, type) {
                    var config = null;
                    if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: {!! $clientsNames !!},
                                datasets: [{
                                    label: "Total of Scanned",
                                    data: [55,20,22,3,4,5],
                                    backgroundColor: '#46b6fe',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }, {
                                    label: "Total of Employyees",
                                    data: [50,100,220,30,40,50],
                                    backgroundColor: '#5CC5CD',
                                    strokeColor: "rgba(255,118,118,0.1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: false
                            }
                        }
                    }
                    return config;
                }

            </script>
        @endsection

    @endif
@endsection
