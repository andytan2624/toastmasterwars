@extends('layouts.app')

@section('content')
    <h1>Create a new user</h1>

    {!! Form::model($user, ['route' => 'users.management.store']) !!}

    @include('users.partials.form')

    <div class="form-group">
        {!! Form::submit('Add User', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop