@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Create a new user</h1>

            {!! Form::model($user, ['action' => 'UserController@store']) !!}

            @include('users.partials.form')

            <div class="form-group">
                {!! Form::submit('Add User', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop