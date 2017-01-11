<div class="row">
    <div class="col-sm-12">
        <h3>Attendance</h3>
        <table class="table table-sm table-bordered text-center">
            <thead>
                <th class="text-center">Members Present</th>
                <th class="text-center">Apologies</th>
                <th class="text-center">Absent Members</th>
                <th class="text-center">Visitors</th>
            </thead>
            <tbody>
            <tr>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $memberPresent])
                </td>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $apologies])
                </td>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $absent])
                </td>
                <td>
                    @include('meetings.partials.agenda.user_list', ['scores' => $visitor])
                </td>
            </tr>
            <tr>
                <td> {{ count($memberPresent) . ' ' . str_plural('person', count($memberPresent)) }}</td>
                <td> {{ count($apologies) . ' ' . str_plural('person', count($apologies)) }}</td>
                <td> {{ count($absent) . ' ' . str_plural('person', count($absent)) }}</td>
                <td> {{ count($visitor) . ' ' . str_plural('person', count($visitor)) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>