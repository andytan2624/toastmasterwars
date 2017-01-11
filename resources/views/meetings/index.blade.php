@extends('layouts.app')

@section('content')
    <h1>Meetings</h1>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <th>Meeting #</th>
            <th>Date</th>
            <th>Chairman</th>
            <th>Secretary</th>
            <th>Serjeant At Arms</th>
            <th></th>
        </thead>
        <tbody>
            @each('meetings.partials.item', $meetings, 'meeting')
        </tbody>
    </table>

@endsection