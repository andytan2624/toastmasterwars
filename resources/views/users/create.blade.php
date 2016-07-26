@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Create a new user</h1>

                {!! Form::model($user, ['action' => 'UserController@store']) !!}

                @include('users.partials.form')

                <div class="form-group">
                    {!! Form::submit('Add User', ['class' => 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop