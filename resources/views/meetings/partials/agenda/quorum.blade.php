<div class="row">
    <div class="col-sm-12">
        <h3>Quorum</h3>
        <p>
            Quorum was established by the Sergeant at Arms. Quorum is 50% plus 1 of the average of active members over
            the last 3 weeks
        </p>
        <table class="table table-sm table-bordered">
            <thead>
                <th>Meeting #</th>
                <th>Meeting Date</th>
                <th>Active Members Present</th>
            </thead>
            <tbody>
                @foreach ($previousMeetings as $meeting)
                    <tr>
                        <td>{{ $meeting->meeting_number }}</td>
                        <td>{{ $meeting->getNiceMeetingDate() }}</td>
                        <td>{{ $meeting->getAttendanceScores() }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-center">
                        Quorum: {{ $otherDetails['quorum'] }}
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

</div>