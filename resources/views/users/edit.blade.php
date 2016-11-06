@extends('layouts.app')

@section('content')
    <h1>Edit a user</h1>

    {!! Form::model($user, ['method' => 'POST', 'route' => ['users.edit', $user->id], 'role' => 'form'])  !!}


    @include('users.partials.form')

    <div class="form-group">
        {!! Form::submit('Add User', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop