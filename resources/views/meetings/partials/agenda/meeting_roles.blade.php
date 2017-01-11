<div class="row">
    <div class="col-sm-12">
        <table class="table table-sm table-bordered">
            <tbody>
            @if (!$toastScore->isEmpty())
                <tr>
                    <th scope="row">Toast</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $toastScore])
                    </td>
                </tr>
            @endif

            @if (!$toastmasterScore->isEmpty())
                <tr>
                    <th scope="row">Toastmaster</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $toastmasterScore])
                    </td>
                </tr>
            @endif

            @if (!$grammarianScore->isEmpty())
                <tr>
                    <th scope="row">Grammarian</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $grammarianScore])
                    </td>
                </tr>
            @endif

            @if (!$mostUseWordScore->isEmpty())
                <tr>
                    <th scope="row">Most Use of the Word</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $mostUseWordScore])
                    </td>
                </tr>
            @endif

            @if (!$ahCounterScore->isEmpty())
                <tr>
                    <th scope="row">Ah Um Counter</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $ahCounterScore])
                    </td>
                </tr>
            @endif

            @if (!$mostAhScore->isEmpty())
                <tr>
                    <th scope="row">Most Ah Ums</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $mostAhScore])
                    </td>
                </tr>
            @endif

            @if (!$riddleMasterScore->isEmpty())
                <tr>
                    <th scope="row">Riddle Master</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $riddleMasterScore])
                    </td>
                </tr>
            @endif

            @if (!$riddleSolverScore->isEmpty())
                <tr>
                    <th scope="row">Solved Riddle</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $riddleSolverScore])
                    </td>
                </tr>
            @endif

            @if (!$listeningPostScore->isEmpty())
                <tr>
                    <th scope="row">Listening Post</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $listeningPostScore])
                    </td>
                </tr>
            @endif

            @if (!$generalEvaluatorScore->isEmpty())
                <tr>
                    <th scope="row">General Evaluation</th>
                    <td>
                        @include('meetings.partials.agenda.user_list', ['scores' => $generalEvaluatorScore])
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>
