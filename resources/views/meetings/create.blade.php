@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Create a new meeting</h1>

                {!! Form::model($meeting, ['action' => 'MeetingController@store']) !!}

                <div class="form-group">
                    {!! Form::label('club_id', 'Club:') !!}
                    {!! Form::select('club_id', $clubs, old('club_id'), ['placeholder' => 'Pick a club']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('chairman', 'Chairman:') !!}
                    {!! Form::select('chairman', $users, old('chairman'), ['placeholder' => 'Pick a chairman']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('serjeant_at_arms', 'Serjeant At Arms:') !!}
                    {!! Form::select('serjeant_at_arms', $users, old('serjeant_at_arms'), ['placeholder' => 'Pick a serjeant at arms']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('secretary', 'Secretary:') !!}
                    {!! Form::select('secretary', $users, old('secretary'), ['placeholder' => 'Pick a secretary']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meeting_number', 'Meeting Number:') !!}
                    {!! Form::text('meeting_number', old('meeting_number'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meeting_date', 'Meeting Date:') !!}
                    {!! Form::date('meeting_date', old('meeting_date')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Meeting', ['class' => 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop