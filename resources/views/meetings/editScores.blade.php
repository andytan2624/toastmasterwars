@extends('layouts.app')

@section('content')
    <h1 class="text-center">Edit Scores</h1>

    <div class="row">
        <div class="col-sm-4">
            {{ link_to_route('meetings.edit','Back to Meeting', ['meetingId' => $meeting->id], ['class' => 'btn btn-primary']) }}
        </div>
    </div>

    @include('meetings.partials.edit.main', [$meeting, $category])

    {!! Form::open(['route' => ['meetings.editScores', $meeting->id, $category->id]]) !!}

    {{-- Show scores to add/edit for the 1st half --}}
    <h2>First Half</h2>
    @include('meetings.partials.edit.scores', [
        $scores,
        $category,
        'half' => 1,
    ])

    <h2>Second Half</h2>
    {{-- Show scores to add/edit for the 1st half --}}
    @include('meetings.partials.edit.scores' , [
        $scores,
        $category,
        'half' => 2,
    ])

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            // When the Add Row button is clicked, then add a new row to the right table
            $('.add-row').on('click', function(e) {
                e.preventDefault();
                var half = $(this).data('half');
                var cloneRow = $('#clone-row-' + half).clone().removeAttr('id').attr('name', '');
                $('#scores-table-' + half).append(cloneRow);
            });
        });
    </script>
@append