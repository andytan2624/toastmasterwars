<div class="row">
    <div class="col-sm-12">
        <h3>Table Topics</h3>
        <table class="table table-bordered">
            <tr>
                <th>Table Topics Master</th>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $tableTopicsMasterScore])
                </td>
                <th>Table Topics Evaluators</th>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $tableTopicsEvaluatorScore])
                </td>
            </tr>
            <tr>
                <th>Table Topics Participants</th>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $tableTopicsParticipantScore])
                </td>
                <th>Table Topics Winner</th>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $tableTopicsWinnerScore])
                </td>
            </tr>
        </table>
    </div>
</div>