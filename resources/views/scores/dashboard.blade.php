@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            {!! Form::open(array('url' => '/', 'method' => 'post')) !!}
            <div class="row">
                <div class="col-sm-4">
                    <div class="input-group date" data-provide="datepicker">
                        Start Date:
                        {!! Form::date('start_date', old('start_date'), [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group date" data-provide="datepicker">
                        End Date:
                        {!! Form::date('end_date', old('end_date'), [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    Meeting
                    <div>
                        {!! Form::select('meeting_id', $meetings, old('meeting_id'), ['placeholder' => 'Pick a meeting...']) !!}
                    </div>
                </div>
            </div>
            <div class="row top-buffer">
                <div class="col-sm-offset-4 col-sm-4">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <th>Rank</th>
                <th>Toastmaster</th>
                <th>Score</th>
                </thead>
                <tbody>
                <?php $rank = 1; ?>
                @foreach($tallyArray as $user_id => $score)
                    @if ($score > 0)
                        <tr>
                            <td>{{ $rank }}</td>
                            <td>{{ $users[$user_id]}}</td>
                            <td>{{ $score }} </td>
                        </tr>
                    @endif
                    <?php $rank ++; ?>
                @endforeach
                </tbody>
            </table>


            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <th>Toastmaster</th>
                <th>Points Breakdown</th>
                </thead>
                <tbody>
                <?php
                foreach ($currentScores as $user_id => $data) {
                if (count($data) > 0) {
                ?>
                <tr>
                    <td><?= $users[$user_id] ?> </td>
                    <td>
                        <ul>
                            <?php
                            foreach ($data as $reason) {
                            ?>
                            <li><?= $reason; ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <?php
                }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('scores_index_js')
    {!! Html::script('/components/parsleyjs/dist/parsley.js') !!}
@endsection