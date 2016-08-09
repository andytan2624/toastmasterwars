@extends('layouts.app)

@section('content')
    <?php
    /**
     * @inject('stats', 'App\Stats')
     */
    ?>
{{ $user }}
@stop
