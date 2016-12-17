@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                {!! Form::open(['route' => 'reporting.management.process']) !!}
                @foreach ($categories as $category)
                    <li class="list-group-item">
                        <div class="radio">
                            <label><input class="category-radio-button" type="radio" name="category_id" value="{{ $category['latest_point']['id'] }}">{{ $category['name'] }}</label>
                        </div>
                    </li>
                @endforeach
                {!! Form::close() !!}
            </ul>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <div id="userGraph"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="meetingGraph"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js_scripts')
    {!! Html::script('/components/highcharts/highcharts.js') !!}
    {!! Html::script('/js/reporting.js') !!}

    <script type="text/javascript">
        // Meeting Graph
        $(function () {
            Highcharts.chart('meetingGraph', {
                title: {
                    text: 'Club Performance - {{ $categoryTitle }}',
                    x: -20 //center
                },
                xAxis: {
                    categories: [
                        <?php
                        echo '"' . implode('","', array_keys($meetingGraphResults)) . '"';
                        ?>
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Number of People'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                series: [{
                    name: 'Persons',
                    data: [
                        {{ implode(",", $meetingGraphResults) }}
                    ]
                }]
            });
        });

        // User Graph
        $(function () {
            Highcharts.chart('userGraph', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Top 20 Toastmasters - {{ $categoryTitle }}'
                },
                xAxis: {
                    categories: [
                        <?php
                        $nameData = [];
                        foreach ($userGraphResults as $userID => $userData) {
                            $nameData[] = $userData['name'];
                        }
                        echo '"' . implode('","', $nameData) . '"';
                        ?>
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number times doing the role',
                    },
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Toastmasters',
                    data: [
                        <?php
                        $countData = [];
                        foreach ($userGraphResults as $userID => $userData) {
                            $countData[] = $userData['count'];
                        }
                        echo implode(',', $countData);
                        ?>
                    ]
                }]
            });
        });
    </script>
@stop