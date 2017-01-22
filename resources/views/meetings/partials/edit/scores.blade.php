<div class="row">
    <div class="col-sm-8">
    </div>
    <div class="col-sm-4">
        <button class="btn btn-primary pull-right add-row" data-half="{{ $half }}">Add Row</button>
    </div>
</div>

<table class="table table-bordered table-sm">
    <thead>
        <th>User</th>
        @if ($category->id == config('constants.categories.speech_id'))
            <th>Speech Title</th>
            <th>Evaluator</th>
            <th>Speech Time</th>
        @elseif ($category->id == config('constants.categories.custom_point_category_id'))
            <th>Point Value</th>
            <th>Notes</th>
        @else
            <th>Notes</th>
        @endif
        <th></th>
    </thead>
    <tbody id="scores-table-{{ $half }}">
        @if ($scores->has($half))
            @foreach ($scores->get($half) as $score)
                <tr>
                    <td>
                        {{ Form::select("users[$half][$score->id]", $users, $score->user->id, ['placeholder' => 'Pick a user']) }}
                    </td>
                    @if ($category->id == config('constants.categories.speech_id'))
                        <td>
                            {!! Form::text("speech_titles[$half][$score->id]", $score->speech_title, ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {{ Form::select("evaluators[$half][$score->id]", $users, $score->evaluator, ['placeholder' => 'Pick a user']) }}
                        </td>
                        <td>
                            {!! Form::text("speaking_times[$half][$score->id]", $score->speaking_time, ['class' => 'form-control']) !!}
                        </td>
                    @elseif ($category->id == config('constants.categories.custom_point_category_id'))
                        <td>
                            {!! Form::text("point_values[$half][$score->id]", $score->point_value, ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {!! Form::text("notes[$half][$score->id]", $score->notes, ['class' => 'form-control']) !!}
                        </td>
                    @else
                        <td>
                            {!! Form::text("notes[$half][$score->id]", $score->notes, ['class' => 'form-control']) !!}
                        </td>
                    @endif

                    <td>
                        <input type="button" class="btn btn-danger" data-toggle="modal" data-target="#remove-score-{{$score->id}}" value="Delete Score"/>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<table class="clone-table hide">
    <tr id="clone-row-{{ $half }}" >
        <td>
            {{ Form::select("users[$half][]", $users, null, ['placeholder' => 'Pick a user']) }}
        </td>
        @if ($category->id == config('constants.categories.speech_id'))
            <td>
                {!! Form::text("speech_titles[$half][]", '', ['class' => 'form-control']) !!}
            </td>
            <td>
                {{ Form::select("evaluators[$half][]", $users, null, ['placeholder' => 'Pick a user']) }}
            </td>
            <td>
                {!! Form::text("speaking_times[$half][]", '', ['class' => 'form-control']) !!}
            </td>
        @elseif ($category->id == config('constants.categories.custom_point_category_id'))
            <td>
                {!! Form::text("point_values[$half][]", '', ['class' => 'form-control']) !!}
            </td>
            <td>
                {!! Form::text("notes[$half][]", '', ['class' => 'form-control']) !!}
            </td>
        @else
            <td>
                {!! Form::text("notes[$half][]", '', ['class' => 'form-control']) !!}
            </td>
        @endif
        <td>
        </td>
    </tr>
</table>


@section('modals')
     {{--For each score, include a modal for it --}}
     @if ($scores->has($half))
        @foreach ($scores->get($half) as $score)
            @include('component.confirmation-modal', [
                'id' => "remove-score-$score->id",
                'title' => "Delete score for Meeting ",
                'form_parameters' => array('route' => array('meetings.deleteScore', 'scoreId' => $score->id)),
                'message' => "Are you sure you want to delete this score?",
            ])
        @endforeach
    @endif
@append