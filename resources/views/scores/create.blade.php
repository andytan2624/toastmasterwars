@extends('layouts.app')

@section('content')
    <h1>Score a point</h1>

    {!! Form::model($score, ['action' => 'ScoreController@store']) !!}

    <div class="form-group">
        {!! Form::label('club_id', 'Club:') !!}
        {!! Form::select('club_id', $clubs, old('club_id'), ['placeholder' => 'Pick a club']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('meeting_id', 'Meeting:') !!}
        {!! Form::select('meeting_id', $meetings, old('meeting_id'), ['placeholder' => 'Pick a meeting']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('user_id', 'User:') !!}
        {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('point_id', 'Point Category:') !!}
        {!! Form::select('point_id', $points, old('point_id'), ['placeholder' => 'Pick a point category']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('custom_point_value', 'Custom Point Value:') !!}
        {!! Form::text('custom_point_value', old('custom_point_value'), ['class' => 'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::label('speech_title', 'Speech Title:') !!}
        {!! Form::text('speech_title', old('speech_title'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_speech', 'Is Speech:') !!}
        {!! Form::checkbox('is_speech') !!}
    </div>

    <div class="form-group">
        {!! Form::label('evaluator', 'Evaluator:') !!}
        {!! Form::select('evaluator', $users, old('evaluator'), ['placeholder' => 'Pick a evaluator']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('notes', 'Notes:') !!}
        {!! Form::text('notes', old('notes'), ['placeholder' => 'Write a note']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Add Score', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop