@extends('layouts.app')

@section('content')
    <h1>Points Breakdown</h1>
    <p>
        The following table breaks down the existing categories a toastmaster can score a point
        and how much points its worth
    </p>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <th>Category</th>
        <th>Points</th>
        </thead>
        <tbody>
        @foreach($meetingCategories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->point_value }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop