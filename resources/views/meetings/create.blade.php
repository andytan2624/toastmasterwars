@extends('layouts.app')

@section('content')
    <h1>Create a new meeting</h1>

    {!! Form::model($meeting, ['action' => 'MeetingController@store']) !!}
    <h2>First Half</h2>
    <!-- Names should only appear on drop down based on attendance-->
    @include('meetings.partials.form')

    <div class="form-group">
        {!! Form::label('attendance', 'Attendance:') !!}
        <input type="search" name="q" id="attendance" class="form-control typeaheadinput" placeholder="Search"
               autocomplete="off">
    </div>

    <ul id="attendance_list"></ul>
    <input type="hidden" id="attendance_ids" name="attendance_ids" value=""/>

    <div class="form-group">
        {!! Form::label('apologies', 'Apologies:') !!}
        <input type="search" name="q" id="apologies" class="form-control typeaheadinput" placeholder="Search"
               autocomplete="off">
    </div>

    <ul id="apologies_list"></ul>
    <input type="hidden" id="apologies_ids" name="apologies_ids" value=""/>

    <div class="form-group">
        {!! Form::label('absent', 'Absent Members:') !!}
        <input type="search" name="q" id="absent" class="form-control typeaheadinput" placeholder="Search"
               autocomplete="off">
    </div>

    <ul id="absent_list"></ul>
    <input type="hidden" id="absent_ids" name="absent_ids" value=""/>

    <div class="form-group">
        {!! Form::label('visitors', 'Visitors:') !!}
        <input type="search" name="q" id="visitors" name="visitors" class="form-control typeaheadinput"
               placeholder="Search" autocomplete="off">
    </div>

    <ul id="visitors_list"></ul>
    <input type="hidden" id="visitors_ids" name="visitors_ids" value=""/>

    <div class="form-group">
        {!! Form::label('riddle_master', 'Riddle Master:') !!}
        {!! Form::select('riddle_master', $users, old('riddle_master'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>
    <!-- Word of the Day -->
    <div class="form-group">
        {!! Form::label('grammarian', 'Grammarian:') !!}
        {!! Form::select('grammarian', $users, old('grammarian'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('word_of_the_day', 'Word of the Day:') !!}
        {!! Form::text('word_of_the_day', old('word_of_the_day'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('toast', 'Toast:') !!}
        {!! Form::select('toast', $users, old('toast'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <!-- Note to include who is Toastmaster-->
    <div class="form-group">
        {!! Form::label('toastmaster_1', 'Toastmaster 1:') !!}
        {!! Form::select('toastmaster_1', $users, old('toastmaster_1'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <!-- Put the next two together-->
    <div class="form-group">
        {!! Form::label('table_topics_master', 'Table Topics Master:') !!}
        {!! Form::select('table_topics_master', $users, old('table_topics_master'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('doing_table_topics', 'Table Topics Competitors:') !!}
        <input type="search" name="q" id="doing_table_topics" class="form-control typeaheadinput"
               placeholder="Search" autocomplete="off">
    </div>

    <ul id="doing_table_topics_list"></ul>
    <input type="hidden" id="doing_table_topics_ids" name="doing_table_topics_ids" value=""/>

    <div class="form-group">
        {!! Form::label('table_topics_evaluator', 'Table Topics Evaluators:') !!}
        <input type="search" name="q" id="table_topics_evaluators" class="form-control typeaheadinput"
               placeholder="Search" autocomplete="off">
    </div>

    <ul id="table_topics_evaluators_list"></ul>
    <input type="hidden" id="table_topics_evaluators_ids" name="table_topics_evaluators_ids" value=""/>

    <div class="form-group">
        {!! Form::label('table_topics_winner', 'Table Topics Winner:') !!}
        {!! Form::select('table_topics_winner', $users, old('table_topics_winner'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <!-- Speeches including who evaluated, and title of Speech, and the order-->
    <h3>Speeches</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Speaker</th>
            <th>Speech Title</th>
            <th>Evaluator</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>{!! Form::select('speech_speaker_1', $users, old('speech_speaker_1'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_title_1', old('speech_title_1'), ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('speech_evaluator_1', $users, old('speech_evaluator_1'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_time_1', old('speech_time_1'), ['class' => 'form-control speech-time']) !!}</td>

        </tr>
        <tr>
            <th scope="row">2</th>
            <td>{!! Form::select('speech_speaker_2', $users, old('speech_speaker_2'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_title_2', old('speech_title_2'), ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('speech_evaluator_2', $users, old('speech_evaluator_2'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_time_2', old('speech_time_2'), ['class' => 'form-control speech-time']) !!}</td>


        </tr>
        <tr>
            <th scope="row">3</th>
            <td>{!! Form::select('speech_speaker_3', $users, old('speech_speaker_3'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_title_3', old('speech_title_3'), ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('speech_evaluator_3', $users, old('speech_evaluator_3'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_time_3', old('speech_time_3'), ['class' => 'form-control speech-time']) !!}</td>


        </tr>
        </tbody>
    </table>

    <!-- 2ND HALF -->
    <hr/>

    <h2>Second Half</h2>
    <div class="form-group">
        {!! Form::label('toastmaster_2', 'Toastmaster 2:') !!}
        {!! Form::select('toastmaster_2', $users, old('toastmaster_2'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <h3>Speeches</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Speaker</th>
            <th>Speech Title</th>
            <th>Evaluator</th>
            <th>Time</th>
        </tr>
        </thead>
        <tr>
            <th scope="row">4</th>
            <td>{!! Form::select('speech_speaker_4', $users, old('speech_speaker_4'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_title_4', old('speech_title_4'), ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('speech_evaluator_4', $users, old('speech_evaluator_4'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_time_4', old('speech_title_4'), ['class' => 'form-control speech-time']) !!}</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>{!! Form::select('speech_speaker_5', $users, old('speech_speaker_5'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_title_5', old('speech_title_5'), ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('speech_evaluator_5', $users, old('speech_evaluator_5'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_time_5', old('speech_time_5'), ['class' => 'form-control speech-time']) !!}</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>{!! Form::select('speech_speaker_6', $users, old('speech_speaker_6'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_title_6', old('speech_title_6'), ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('speech_evaluator_6', $users, old('speech_evaluator_6'), ['placeholder' => 'Pick a user']) !!}</td>
            <td>{!! Form::text('speech_time_6', old('speech_time_6'), ['class' => 'form-control speech-time']) !!}</td>

        </tr>
        </tbody>
    </table>

    <div class="form-group">
        {!! Form::label('ah_counter', 'Ah Counter:') !!}
        {!! Form::select('ah_counter', $users, old('ah_counter'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('timer', 'Timer:') !!}
        {!! Form::select('timer', $users, old('timer'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('most_ahs', 'Most Ahs:') !!}
        {!! Form::select('most_ahs', $users, old('most_ahs'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <!-- Multiple-->
    <div class="form-group">
        {!! Form::label('most_use_word', 'Most Use of the Word of the Day:') !!}
        {!! Form::select('most_use_word', $users, old('most_use_word'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}

    </div>

    <!-- Multiple -->
    <div class="form-group">
        {!! Form::label('solved_riddle', 'Solved Riddle:') !!}
        {!! Form::select('solved_riddle', $users, old('solved_riddle'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('listening_post', 'Listening Post:') !!}
        {!! Form::select('listening_post', $users, old('listening_post'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('general_evaluator', 'General Evaluator:') !!}
        {!! Form::select('general_evaluator', $users, old('general_evaluator'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Add Meeting', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop

@section('js_scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.1.1/typeahead.bundle.min.js"
            integrity="sha256-ZA+bBTKKj2rKgqw96IjkkZazTWUbroOtZxrzF1ww02A="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
    {!! Html::script('/js/meetings.js') !!}
@append