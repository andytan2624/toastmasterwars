<div class="row">
    <div class="col-sm-12">
        <table class="table table-sm table-bordered">
            <tbody>
            <tr>
                <th scope="row">Date</th>
                <td> {{ $meeting->getNiceMeetingDate() }}</td>
            </tr>
            <tr>
                <th scope="row">Theme</th>
                <td> {{ $meeting->theme }}</td>
            </tr>
            <tr>
                <th scope="row">Started</th>
                <td colspan="2">{{ $meeting->meeting_start_time }}</td>
            </tr>
            <tr>
                <th scope="row">Chairman</th>
                <td colspan="2">{{ $meeting->chairmanUser }}</td>
            </tr>
            <tr>
                <th scope="row">Secretary</th>
                <td colspan="2">{{ $meeting->secretaryUser }}</td>
            </tr>
            <tr>
                <th scope="row">Sergeant at Arms</th>
                <td colspan="2">{{ $meeting->serjeantAtArmsUser }}</td>
            </tr>
            <tr>
                <th scope="row">Venue</th>
                <td colspan="2">{{ $meeting->club }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>