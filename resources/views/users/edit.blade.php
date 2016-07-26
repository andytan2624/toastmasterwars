@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Edit a user</h1>

                {!! Form::model($user, ['method' => 'POST', 'route' => ['users.update', $user->id], 'role' => 'form'])  !!}

                {{ method_field('PATCH') }}

                @include('users.partials.form')

                <div class="form-group">
                    {!! Form::submit('Edit User', ['class' => 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop