@extends('layouts.app')

@section('content')
    <!-- Login Form -->
    <div class="nb-login">
        <h3 class="scenter">Login</h3>
        <form method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <button type="submit" class="btn btn-block">Sign In</button>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>

        </form>
    </div>
@endsection
