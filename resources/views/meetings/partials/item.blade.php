<tr>
    <td>{{ $meeting->meeting_number }}</td>
    <td>{{ $meeting->getNiceMeetingDate() }}</td>
    <td>{{ $meeting->chairmanUser->getFullNameAttribute() }}</td>
    <td>{{ $meeting->serjeantAtArmsUser->getFullNameAttribute() }}</td>
    <td>{{ $meeting->secretaryUser->getFullNameAttribute() }}</td>
    <td>
        {{ link_to_route('meeting.show', 'View', ['id' => $meeting->id], ['class' => 'm-1 btn btn-primary']) }}
        @if (isSuperAdminUser())
            {{ link_to_route('meetings.edit', 'Edit', ['id' => $meeting->id], ['class' => 'm-1 btn btn-success']) }}
            <input type="button" class="m-1 btn btn-danger" data-toggle="modal" data-target="#remove-meeting-{{$meeting->id}}" value="Delete"/>
        @endif
    </td>
</tr>

@if (isSuperAdminUser())
@section('modals')
    @include('component.confirmation-modal', [
        'id' => "remove-meeting-$meeting->id",
        'title' => "Delete score for Meeting ",
        'form_parameters' => array('route' => array('meetings.delete', 'id' => $meeting->id)),
        'message' => "Are you sure you want to delete this meeting?",
    ])
@append
@endif