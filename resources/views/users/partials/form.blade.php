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
    {!! Form::select('club_id', $clubs, old('club_id'), ['placeholder' => 'Pick a club']) !!}
</div>

<div class="form-group">
    {!! Form::label('executive_role_id', 'Executive Role:') !!}
    {!! Form::select('executive_role_id', $executive_roles, old('executive_role_id'), ['placeholder' => 'Pick a role']) !!}
</div>
