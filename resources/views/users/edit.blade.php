@extends('layouts.app')

@section('content')
    <h1>Edit a user</h1>

    {!! Form::model($user, ['method' => 'POST', 'route' => ['users.management.update', 1], 'role' => 'form'])  !!}

    @include('users.partials.form')

    <div class="form-group">
        {!! Form::submit('Save details', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

    {{ link_to_route('users.view', 'Back', [], ['class' => 'btn btn-danger']) }}

@stop