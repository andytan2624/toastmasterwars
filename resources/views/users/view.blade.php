@extends('layouts.app')

@section('content')

    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <th>User</th>
        <th>Club</th>
        <th>Date Joined</th>
        @if (isSuperAdminUser())
            <th>Edit</th>
            <th>Delete</th>
        @endif
        </thead>
        <tbody>
        @foreach ($users as $user)
            @foreach ($user['user_clubs'] as $userClub)
                @include('users.partials.item', ['user' => $user, 'userClub' => $userClub])
            @endforeach
        @endforeach
        </tbody>
    </table>

@endsection