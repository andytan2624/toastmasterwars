@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Meeting #{{ $meeting->meeting_number }}</h1>

        @include('meetings.partials.agenda.main', [$meeting])

        @include('meetings.partials.agenda.quorum', [$previousMeetings, $otherDetails])

        @include('meetings.partials.agenda.attendance', [
            // Pass in attendance details from the first half
            'memberPresent' => $scores->get(1)->get(config('constants.categories.attendance_id')),
            'apologies' => $scores->get(1)->get(config('constants.categories.apology_id')),
            'absent' => $scores->get(1)->get(config('constants.categories.absent_id')),
            'visitor' => $scores->get(1)->get(config('constants.categories.visitor_id'))
        ])

        <h2>First Half</h2>

        @include('meetings.partials.agenda.meeting_roles', [
            'toastScore' => $scores->get(1)->get(config('constants.categories.toast_id')),
            'toastmasterScore' => $scores->get(1)->get(config('constants.categories.toastmaster_id')),
            'grammarianScore' => $scores->get(1)->get(config('constants.categories.grammarian_id')),
            'mostUseWordScore' => $scores->get(1)->get(config('constants.categories.most_use_word_id')),
            'ahCounterScore' => $scores->get(1)->get(config('constants.categories.ah_counter_id')),
            'mostAhScore' => $scores->get(1)->get(config('constants.categories.most_ahs_id')),
            'riddleMasterScore' => $scores->get(1)->get(config('constants.categories.riddle_master_id')),
            'riddleSolverScore' => $scores->get(1)->get(config('constants.categories.solving_riddle_id')),
            'listeningPostScore' => $scores->get(1)->get(config('constants.categories.listening_post_id')),
            'generalEvaluatorScore' => $scores->get(1)->get(config('constants.categories.general_evaluator_id')),
        ])

        @include('meetings.partials.agenda.table_topics', [
            'tableTopicsMasterScore' => $scores->get(1)->get(config('constants.categories.table_topics_master_id')),
            'tableTopicsEvaluatorScore' => $scores->get(1)->get(config('constants.categories.table_topics_evaluation_id')),
            'tableTopicsWinnerScore' => $scores->get(1)->get(config('constants.categories.table_topics_winner_id')),
            'tableTopicsParticipantScore' => $scores->get(1)->get(config('constants.categories.table_topics_participant_id')),
        ])

        @include('meetings.partials.agenda.speech', [
            'speechScores' => $scores->get(1)->get(config('constants.categories.speech_id'))
        ])

        <h3>Business Session Notes</h3>
        <div class="row">
            <div class="col-sm-12">
                <p>
                    {!! $meeting->business_session ?: 'Business session was not run on the day' !!}
                </p>
            </div>
        </div>

        <h1>Second Half</h1>

        @if (!$scores->get(2)->get(config('constants.categories.table_topics_master_id'))->isEmpty()))
            @include('meetings.partials.agenda.table_topics', [
                'tableTopicsMasterScore' => $scores->get(2)->get(config('constants.categories.table_topics_master_id')),
                'tableTopicsEvaluatorScore' => $scores->get(2)->get(config('constants.categories.table_topics_evaluation_id')),
                'tableTopicsWinnerScore' => $scores->get(2)->get(config('constants.categories.table_topics_winner_id')),
                'tableTopicsParticipantScore' => $scores->get(2)->get(config('constants.categories.table_topics_participant_id')),
            ])
        @endif

        @include('meetings.partials.agenda.speech', [
            'speechScores' => $scores->get(2)->get(config('constants.categories.speech_id'))
        ])

        @include('meetings.partials.agenda.meeting_roles', [
            'toastScore' => $scores->get(2)->get(config('constants.categories.toast_id')),
            'toastmasterScore' => $scores->get(2)->get(config('constants.categories.toastmaster_id')),
            'grammarianScore' => $scores->get(2)->get(config('constants.categories.grammarian_id')),
            'mostUseWordScore' => $scores->get(2)->get(config('constants.categories.most_use_word_id')),
            'ahCounterScore' => $scores->get(2)->get(config('constants.categories.ah_counter_id')),
            'mostAhScore' => $scores->get(2)->get(config('constants.categories.most_ahs_id')),
            'riddleMasterScore' => $scores->get(2)->get(config('constants.categories.riddle_master_id')),
            'riddleSolverScore' => $scores->get(2)->get(config('constants.categories.solving_riddle_id')),
            'listeningPostScore' => $scores->get(2)->get(config('constants.categories.listening_post_id')),
            'generalEvaluatorScore' => $scores->get(2)->get(config('constants.categories.general_evaluator_id')),
        ])

        @if (!$scores->get('other')->isEmpty())
            @include('meetings.partials.agenda.custom_scores', [
                'scores' => $scores->get('other')
            ])
        @endif
        <hr/>

        <div class="row">
            <div class="col-sm-12">
                <p>Meeting Closed: {{ $meeting->meeting_end_time }}</p>
                <p>Next Meeting: {{ $meeting->next_meeting_date }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p>
                    Signed as a true and accurate record
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Chairman _______________________</p>
                <p class="text-right">Date: ___/___/___ </p>
            </div>
            <div class="col-sm-6">
                <p>Secretary _______________________</p>
                <p class="text-right">Date: ___/___/___ </p>
            </div>
        </div>
    </div>
@endsection