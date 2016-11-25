@extends('layouts.app')

@section('content')

    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <th>User</th>
        <th>Club</th>
        <th>Date Joined</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach ($users as $user)
            @foreach ($user['user_clubs'] as $userClub)
                <tr>
                    <td>{{ "$user[first_name] $user[last_name]" }}</td>
                    <td>{{ $userClub['club']['name'] }}</td>
                    <td>{{ $userClub['date_joined'] }}</td>
                    <td>{{ link_to_route('users.management.edit', 'Edit', ['id' => $user['id']], ['class' => 'btn btn-primary']) }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

@endsection