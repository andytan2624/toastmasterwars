@extends('layouts.app')

@section('content')
    <h1>Edit Meeting #{{ $meeting->meeting_number }}</h1>

    <div class="row">
        <div class="col-sm-4">
            {{ link_to_route('meetings.view','View All Meetings', [], ['class' => 'btn btn-primary']) }}
        </div>
    </div>

    {!! Form::model($meeting, ['route' => ['meetings.update', $meeting->id]]) !!}

    @include('meetings.partials.form')

    <div class="form-group">
        {!! Form::submit('Save Meeting', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

    <hr>

    <h2>Roles Witin Meetings</h2>
    <table class="table table-bordered">
        <tr>
            <th></th>
            <th>1st Half</th>
            <th>2nd Half</th>
            <th></th>
        </tr>
        @foreach ($scores as $score)
            <tr>
                <td>{{ $score->get('categoryDetails') }}</td>
                <td>
                    <ul>
                        @foreach ($score->get(1) as $scoreuser)
                            <li>{{ $scoreuser->user }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($score->get(2) as $scoreuser)
                            <li>{{ $scoreuser->user }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    {{ link_to_route('meetings.editScores', 'Edit Scores', ['meetingId' => $meeting->id, 'categoryId' => $score->get('categoryDetails')], ['class' => 'btn btn-success']) }}
                </td>
            </tr>
        @endforeach
    </table>
@stop

