@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => 'reporting.management.process']) !!}
    <div class="row">
        <div class="offset-lg-4 col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Start Date</button>
                </span>
                        {!! Form::text('start_date', old('start_date'), [
                            'class' => 'form-control datepicker',
                            'id'    => 'reportStartDate'
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">End Date</button>
                </span>
                        {!! Form::text('end_date', old('end_date'), [
                            'class' => 'form-control datepicker',
                            'id'    => 'reportEndDate'
                        ]) !!}            </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                {!! Form::radio('category_id', $category['latest_point']['id'], false, [ 'class' => 'category-radio-button']) !!} {{ $category['name'] }}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    @if (count($userResults) > 0)
                        <h2 class="text-center">{{ $categoryTitle }} Rankings</h2>
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <th>Rank</th>
                            <th>Toastmaster</th>
                            <th>Count</th>
                            </thead>
                            <tbody>
                            <?php $rank = 1; ?>
                            @foreach($userResults as $userData)
                                <tr>
                                    <td>{{ $rank }}</td>
                                    <td>{{ $userData['name']}}</td>
                                    <td>{{ $userData['count']}}</td>
                                </tr>
                                <?php $rank ++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js_scripts')
    {!! Html::script('/js/reporting.js') !!}

    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            maxViewMode: 2,
            clearBtn: true,
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true
        });

        $("#reportStartDate").datepicker("update", '{{ $start_date }}');
        $("#reportEndDate").datepicker("update", '{{ $end_date }}');
    </script>
@append