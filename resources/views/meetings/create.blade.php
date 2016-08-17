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
                <!-- Should have the next number of meeting after the last one-->
                <div class="form-group">
                    {!! Form::label('meeting_number', 'Meeting Number:') !!}
                    {!! Form::text('meeting_number', old('meeting_number'), ['class' => 'form-control']) !!}
                </div>
                <!-- Calculate the latest date based on month, next Thursday date from the last one -->
                <div class="form-group">
                    {!! Form::label('meeting_date', 'Meeting Date:') !!}
                    {!! Form::date('meeting_date', old('meeting_date')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meeting_start_time', 'Meeting Start Time:') !!}
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
                    {!! Form::label('attendance', 'Attendance:') !!}
                    {!! Form::text('attendance', '', ['class' => 'form-control']) !!}
                    <input type="search" name="q" id="testautocomplete" class="form-control" placeholder="Search" autocomplete="off">
                </div>

                <div class="form-group">
                    {!! Form::label('apologies', 'Apologies:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('absent', 'Absent Members:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('visitors', 'Visitors:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('riddle_master', 'Riddle Master:') !!}
                </div>
                <!-- Multiple -->
                <div class="form-group">
                    {!! Form::label('solved_riddle', 'Solved Riddle:') !!}
                </div>

                <!-- Word of the Day -->
                <div class="form-group">
                    {!! Form::label('grammarian', 'Grammarian:') !!}
                </div>
                <!-- Multiple-->
                <div class="form-group">
                    {!! Form::label('most_use_word', 'Most Use of the Word of the Day:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('toast', 'Toast:') !!}
                </div>

                <!-- Note to include who is Toastmaster-->
                <div class="form-group">
                    {!! Form::label('toastmaster_1', 'Toastmaster 1:') !!}
                </div>

                <!-- Put the next two together-->
                <div class="form-group">
                    {!! Form::label('table_topics_master', 'Table Topics Master:') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('table_topics_winner', 'Table Topics Winner:') !!}
                </div>

                <!-- Speeches including who evaluated, and title of Speech, and the order-->
                <div class="form-group">
                    {!! Form::label('speech', 'Speech:') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('evaluator', 'Evaluator:') !!}
                </div>

                <!-- 2ND HALF -->

                <div class="form-group">
                    {!! Form::label('toastmaster_2', 'Toastmaster 2:') !!}
                </div>

                <!-- Speeches including who evaluated, and title of Speech-->
                <div class="form-group">
                    {!! Form::label('speech', 'Speech:') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('evaluator', 'Evaluator:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('ah_counter', 'Ah Counter:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('most_ahs', 'Most Ahs:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('listening_post', 'Listening Post:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('general_evaluator', 'General Evaluator:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meeting_end_time', 'Meeting End Time:') !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Meeting', ['class' => 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop