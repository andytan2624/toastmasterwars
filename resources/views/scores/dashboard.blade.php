@extends('layouts.app')

@section('content')

    {!! Form::open(array('url' => '/', 'method' => 'post')) !!}

    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Start Date</button>
                </span>
                {!! Form::text('start_date', old('start_date'), ['class' => 'form-control datepicker' ]) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">End Date</button>
                </span>
                {!! Form::text('end_date', old('end_date'), [
                    'class' => 'form-control datepicker',
                ]) !!}            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Meeting</button>
                </span>
                {!! Form::select('meeting_id', $meetings->take(10), old('meeting_id'), ['placeholder' => 'Pick a meeting...']) !!}
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="offset-lg-4 col-lg-4">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </div>

    {!! Form::close() !!}

    <hr/>

    <div>
        <div class="col-lg-12 pagehead">
            <h1 class="title">Scoreboard: ({{ $prettyStartDate }}) - ({{ $prettyEndDate }}) </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 fact">
                            <div class="huge">{{ count($meetingData) }}</div>
                            <div># of Meetings</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 fact">
                            <div class="huge">{{ round(array_sum($meetingData) / count($meetingData), 2) }}</div>
                            <div>Average Attendance</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="attendance-graph"></div>
        </div>
    </div>

    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <th>Rank</th>
        <th>Toastmaster</th>
        <th>Attendance</th>
        <th>Speech</th>
        <th>Evaluation</th>
        <th>Manuals</th>
        <th>Competition</th>
        <th>Score</th>
        </thead>
        <tbody>
        <?php $rank = 1; ?>
        @foreach($tallyArray as $user_id => $score)
            @if ($score > 0)
                <tr>
                    <td>{{ $rank }}</td>
                    <td>{{ $users[$user_id]}}</td>
                    <td>{{ $userData[$user_id]['meetingsAttended']}}</td>
                    <td>{{ $userData[$user_id]['speechCount']}}</td>
                    <td>{{ $userData[$user_id]['speechEvaluations']}}</td>
                    <td>{{ $userData[$user_id]['manualsCompleted']}}</td>
                    <td>{{ $userData[$user_id]['enteredCompetition']}}</td>
                    <td>{{ $score }} </td>
                </tr>
            @endif
            <?php $rank ++; ?>
        @endforeach
        </tbody>
    </table>



@stop

@section('js_scripts')
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            maxViewMode: 2,
            clearBtn: true,
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true
        });

        Highcharts.chart('attendance-graph', {

            title: {
                text: 'Attendance Per Meeting'
            },

            xAxis: {
                categories: [
                    <?php
                    echo '"' . implode('","', array_keys($meetingData)) . '"';
                    ?>
                ]
            },

            yAxis: {
                title: {
                    text: 'Attendance'
                }
            },

            series: [{
                name: 'Installation',
                data: [ {{ implode(",", $meetingData) }} ]
            }]

        });
    </script>



@endsection