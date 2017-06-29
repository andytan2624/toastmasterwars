<div class="form-group">
    {!! Form::label('club_id', 'Club:') !!}
    {!! Form::select('club_id', $clubs, old('club_id'), ['placeholder' => 'Pick a club', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('chairman', 'Chairman:') !!}
    {!! Form::select('chairman', $users, old('chairman'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('serjeant_at_arms', 'Serjeant At Arms:') !!}
    {!! Form::select('serjeant_at_arms', $users, old('serjeant_at_arms'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('secretary', 'Secretary:') !!}
    {!! Form::select('secretary', $users, old('secretary'), ['placeholder' => 'Pick a user', 'class' => 'form-control']) !!}
</div>

<!-- Should have the next number of meeting after the last one-->
<div class="form-group">
    {!! Form::label('meeting_number', 'Meeting Number:') !!}
    @if (is_int($nextMeetingID))
        {!! Form::text('meeting_number', $nextMeetingID, old('meeting_number'), ['class' => 'form-control']) !!}
    @else
        {!! Form::text('meeting_number', old('meeting_number'), ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Calculate the latest date based on month, next Thursday date from the last one -->
<div class="form-group">
    {!! Form::label('meeting_date', 'Meeting Date:') !!}
    {!! Form::date('meeting_date', old('meeting_date'), ['class' => ' form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('meeting_start_time', 'Meeting Start Time:') !!}
    {!! Form::text('meeting_start_time', old('meeting_start_time'), ['class' => 'form-control', 'id' => 'meeting_start_time']) !!}
</div>

<div class="form-group">
    {!! Form::label('meeting_end_time', 'Meeting End Time:') !!}
    {!! Form::text('meeting_end_time', old('meeting_end_time'), ['class' => 'form-control', 'id' => 'meeting_end_time']) !!}
</div>

@section('js_scripts')
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            maxViewMode: 2,
            clearBtn: true,
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true
        });
    </script>



@endsection