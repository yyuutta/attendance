@extends('layouts.app')

@section('content')
 
<div>
    {!! Form::open(['route' => 'login.post']) !!}
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
</div>
 
@endsection