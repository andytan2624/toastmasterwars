<tr>
    <td>{{ "$user[first_name] $user[last_name]" }}</td>
    <td>{{ $userClub['club']['name'] }}</td>
    <td>{{ $userClub['date_joined'] }}</td>
    @if (isSuperAdminUser())
        <td>{{ link_to_route('users.management.edit', 'Edit', ['id' => $user['id']], ['class' => 'btn btn-primary']) }}</td>
        <td>
            <input type="button" class="btn btn-danger" data-toggle="modal" data-target="#remove-user-membership-{{$user['id']}}" value="Delete"/>
        </td>
    @endif
</tr>

@section('modals')
    @if (isSuperAdminUser())
        @include('component.confirmation-modal', [
            'id' => "remove-user-membership-$user[id]",
            'title' => "Delete $user[first_name] membership to all clubs",
            'form_parameters' => array('route' => array('users.management.delete', $user['id'])),
            'message' => "Are you sure you want to delete $user[first_name] membership to ".$userClub['club']['name'],
        ])
    @endif
@append