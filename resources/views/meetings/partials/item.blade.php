<tr>
    <td>{{ $meeting->meeting_number }}</td>
    <td>{{ $meeting->getNiceMeetingDate() }}</td>
    <td>{{ $meeting->chairmanUser->getFullNameAttribute() }}</td>
    <td>{{ $meeting->serjeantAtArmsUser->getFullNameAttribute() }}</td>
    <td>{{ $meeting->secretaryUser->getFullNameAttribute() }}</td>
    <td>
        {{ link_to_route('meeting.show', 'View', ['id' => $meeting->id], ['class' => 'btn btn-primary']) }}
        {{ link_to_route('meetings.edit', 'Edit', ['id' => $meeting->id], ['class' => 'btn btn-success']) }}
    </td>
</tr>