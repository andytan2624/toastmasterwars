@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <ul class="list-group">
                {!! Form::open(['route' => 'reporting.management.process']) !!}
                @foreach ($categories as $category)
                    <li class="list-group-item">
                        <div class="radio">
                            <label><input class="category-radio-button" type="radio" name="category_id" value="{{ $category['latest_point']['id'] }}">{{ $category['name'] }}</label>
                        </div>
                    </li>
                @endforeach
                {!! Form::close() !!}
            </ul>
        </div>
        <div class="col-lg-8">

        </div>
    </div>
@stop

@section('js_scripts')
    {!! Html::script('/js/reporting.js') !!}
@stop