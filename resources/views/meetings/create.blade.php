@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Create a new meeting</h1>

                {!! Form::model($meeting, ['action' => 'MeetingController@store']) !!}
                        <!-- Names should only appear on drop down based on attendance-->
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
                    {!! Form::text('meeting_time', old('meeting_time'), ['class' => 'form-control', 'id' => 'meeting_time']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attendance', 'Attendance:') !!}
                    <input type="search" name="q" id="attendance" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="attendance_list"></ul>
                <input type="hidden" id="attendance_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('apologies', 'Apologies:') !!}
                    <input type="search" name="q" id="apologies" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="apologies_list"></ul>
                <input type="hidden" id="apologies_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('absent', 'Absent Members:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('visitors', 'Visitors:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('riddle_master', 'Riddle Master:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>
                <!-- Multiple -->
                <div class="form-group">
                    {!! Form::label('solved_riddle', 'Solved Riddle:') !!}
                </div>

                <!-- Word of the Day -->
                <div class="form-group">
                    {!! Form::label('grammarian', 'Grammarian:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>
                <!-- Multiple-->
                <div class="form-group">
                    {!! Form::label('most_use_word', 'Most Use of the Word of the Day:') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('toast', 'Toast:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Note to include who is Toastmaster-->
                <div class="form-group">
                    {!! Form::label('toastmaster_1', 'Toastmaster 1:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Put the next two together-->
                <div class="form-group">
                    {!! Form::label('table_topics_master', 'Table Topics Master:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('table_topics_winner', 'Table Topics Winner:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Speeches including who evaluated, and title of Speech, and the order-->
                <div class="form-group">
                    {!! Form::label('speech', 'Speech:') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('evaluator', 'Evaluator:') !!}
                </div>

                <!-- 2ND HALF -->
                <hr/>

                <div class="form-group">
                    {!! Form::label('toastmaster_2', 'Toastmaster 2:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
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
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('most_ahs', 'Most Ahs:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('listening_post', 'Listening Post:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('general_evaluator', 'General Evaluator:') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['placeholder' => 'Pick a user']) !!}
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