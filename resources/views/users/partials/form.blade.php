<div class="form-group">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('member_number', 'Member Number:') !!}
    {!! Form::text('member_number', old('member_number'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('date_joined', 'Date Joined:') !!}
    {!! Form::date('date_joined', old('date_joined')) !!}
</div>

<div class="form-group">
    {!! Form::label('club_id', 'Club:') !!}
{{--    {!! Form::select('club_id', $clubs, old('club_id', 1), ['placeholder' => 'Pick a club']) !!}--}}
    {!! Form::select('club_id[]', $clubs, $relatedClubs, ['multiple', 'placeholder' => 'Pick a club']) !!}
</div>
{{--{{ Form::select('roles[]', $roles, array_pluck($user->roles, 'id'), ['multiple']) }}--}}