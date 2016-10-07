@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Create a new meeting</h1>

                {!! Form::model($meeting, ['action' => 'MeetingController@store']) !!}
                <h2>First Half</h2>
                        <!-- Names should only appear on drop down based on attendance-->
                <div class="form-group">
                    {!! Form::label('club_id', 'Club:') !!}
                    {!! Form::select('club_id', $clubs, old('club_id'), ['placeholder' => 'Pick a club']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('chairman', 'Chairman:') !!}
                    {!! Form::select('chairman', $users, old('chairman'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('serjeant_at_arms', 'Serjeant At Arms:') !!}
                    {!! Form::select('serjeant_at_arms', $users, old('serjeant_at_arms'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('secretary', 'Secretary:') !!}
                    {!! Form::select('secretary', $users, old('secretary'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Should have the next number of meeting after the last one-->
                <div class="form-group">
                    {!! Form::label('meeting_number', 'Meeting Number:') !!}
                    {!! Form::text('meeting_number', $nextMeetingID, ['class' => 'form-control']) !!}
                </div>

                <!-- Calculate the latest date based on month, next Thursday date from the last one -->
                <div class="form-group">
                    {!! Form::label('meeting_date', 'Meeting Date:') !!}
                    {!! Form::date('meeting_date', old('meeting_date')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meeting_start_time', 'Meeting Start Time:') !!}
                    {!! Form::text('meeting_start_time', old('meeting_start_time'), ['class' => 'form-control', 'id' => 'meeting_start_time']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attendance', 'Attendance:') !!}
                    <input type="search" name="q" id="attendance" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="attendance_list"></ul>
                <input type="hidden" id="attendance_ids"  name="attendance_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('apologies', 'Apologies:') !!}
                    <input type="search" name="q" id="apologies" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="apologies_list"></ul>
                <input type="hidden" id="apologies_ids" name="apologies_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('absent', 'Absent Members:') !!}
                    <input type="search" name="q" id="absent" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="absent_list"></ul>
                <input type="hidden" id="absent_ids" name="absent_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('visitors', 'Visitors:') !!}
                    <input type="search" name="q" id="visitors" name="visitors" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="visitors_list"></ul>
                <input type="hidden" id="visitors_ids"  name="visitors_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('riddle_master', 'Riddle Master:') !!}
                    {!! Form::select('riddle_master', $users, old('riddle_master'), ['placeholder' => 'Pick a user']) !!}
                </div>
                <!-- Word of the Day -->
                <div class="form-group">
                    {!! Form::label('grammarian', 'Grammarian:') !!}
                    {!! Form::select('grammarian', $users, old('grammarian'), ['placeholder' => 'Pick a user']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('word_of_the_day', 'Word of the Day:') !!}
                    {!! Form::text('word_of_the_day', old('word_of_the_day'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('toast', 'Toast:') !!}
                    {!! Form::select('toast', $users, old('toast'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Note to include who is Toastmaster-->
                <div class="form-group">
                    {!! Form::label('toastmaster_1', 'Toastmaster 1:') !!}
                    {!! Form::select('toastmaster_1', $users, old('toastmaster_1'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Put the next two together-->
                <div class="form-group">
                    {!! Form::label('table_topics_master', 'Table Topics Master:') !!}
                    {!! Form::select('table_topics_master', $users, old('table_topics_master'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('doing_table_topics', 'Table Topics Competitors:') !!}
                    <input type="search" name="q" id="doing_table_topics" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="doing_table_topics_list"></ul>
                <input type="hidden" id="doing_table_topics_ids" name="doing_table_topics_ids" value=""/>

                <div class="form-group">
                    {!! Form::label('table_topics_evaluator', 'Table Topics Evaluators:') !!}
                    <input type="search" name="q" id="table_topics_evaluators" class="form-control typeaheadinput" placeholder="Search" autocomplete="off">
                </div>

                <ul id="table_topics_evaluators_list"></ul>
                <input type="hidden" id="table_topics_evaluators_ids" name="table_topics_evaluators_ids" value=""/>


                <div class="form-group">
                    {!! Form::label('table_topics_evaluator_2', 'Table Topics Evaluator 2:') !!}
                    {!! Form::select('table_topics_evaluator_2', $users, old('table_topics_evaluator_2'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('table_topics_winner', 'Table Topics Winner:') !!}
                    {!! Form::select('table_topics_winner', $users, old('table_topics_winner'), ['placeholder' => 'Pick a user']) !!}
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
                    {!! Form::select('toastmaster_2', $users, old('toastmaster_2'), ['placeholder' => 'Pick a user']) !!}
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
                        <td></td>
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
                    {!! Form::select('ah_counter', $users, old('ah_counter'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('timer', 'Timer:') !!}
                    {!! Form::select('timer', $users, old('timer'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('most_ahs', 'Most Ahs:') !!}
                    {!! Form::select('most_ahs', $users, old('most_ahs'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <!-- Multiple-->
                <div class="form-group">
                    {!! Form::label('most_use_word', 'Most Use of the Word of the Day:') !!}
                    {!! Form::select('most_use_word', $users, old('most_use_word'), ['placeholder' => 'Pick a user']) !!}

                </div>

                <!-- Multiple -->
                <div class="form-group">
                    {!! Form::label('solved_riddle', 'Solved Riddle:') !!}
                    {!! Form::select('solved_riddle', $users, old('solved_riddle'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('listening_post', 'Listening Post:') !!}
                    {!! Form::select('listening_post', $users, old('listening_post'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('general_evaluator', 'General Evaluator:') !!}
                    {!! Form::select('general_evaluator', $users, old('general_evaluator'), ['placeholder' => 'Pick a user']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meeting_end_time', 'Meeting End Time:') !!}
                    {!! Form::text('meeting_end_time', old('meeting_end_time'), ['class' => 'form-control', 'id' => 'meeting_end_time']) !!}

                </div>

                <div class="form-group">
                    {!! Form::submit('Add Meeting', ['class' => 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('meeting_create_js')
    <script src="/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: '/findUser?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".typeaheadinput").typeahead({
                hint: true,
                highlight: true,
                minLength: 2
            }, {
                source: engine.ttAdapter(),

                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'usersList',
                display: 'first_name',
                // COULD HAVE SOEMTHING TO DO WITH SETTING RETURN TYPE AS JSONP
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                        return '<div class="list-group-item">' + data.first_name + ' ' + data.last_name + '</div>'
                    }
                }
            });

            $('#attendance').bind('typeahead:select', function(ev, suggestion) {
                $('#attendance_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
                $('#attendance_ids').val(suggestion.id + '|' + $('#attendance_ids').val() );
                $('.typeaheadinput').typeahead('val','');

            });

            $('#apologies').bind('typeahead:select', function(ev, suggestion) {
                $('#apologies_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
                $('#apologies_ids').val(suggestion.id + '|' + $('#apologies_ids').val() );
                $('.typeaheadinput').typeahead('val','');
            });

            $('#absent').bind('typeahead:select', function(ev, suggestion) {
                $('#absent_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
                $('#absent_ids').val(suggestion.id + '|' + $('#absent_ids').val() );
                $('.typeaheadinput').typeahead('val','');
            });

            $('#visitors').bind('typeahead:select', function(ev, suggestion) {
                $('#visitors_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
                $('#visitors_ids').val(suggestion.id + '|' + $('#visitors_ids').val() );
                $('.typeaheadinput').typeahead('val','');
            });

            $('#doing_table_topics').bind('typeahead:select', function(ev, suggestion) {
                $('#doing_table_topics_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
                $('#doing_table_topics_ids').val(suggestion.id + '|' + $('#doing_table_topics_ids').val() );
                $('.typeaheadinput').typeahead('val','');
            });

            $('#table_topics_evaluators').bind('typeahead:select', function(ev, suggestion) {
                $('#table_topics_evaluators_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
                $('#table_topics_evaluators_ids').val(suggestion.id + '|' + $('#table_topics_evaluators_ids').val() );
                $('.typeaheadinput').typeahead('val','');
            });


        });

        $('#meeting_start_time').timepicker();
        $('#meeting_end_time').timepicker();
        $('.speech-time').timepicker({
            'showMeridian' : false,
            'defaultTime': false
        });
    </script>
@endsection