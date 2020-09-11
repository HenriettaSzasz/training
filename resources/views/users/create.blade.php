@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Add a new user</h1>
            <a class="btn btn-danger pull-left " href="{{ route('users.index') }}">Back</a>
        </div>

        {{ Form::open(array('route' => 'users.store')) }}
        @csrf

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', Request::old('email'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('verified', 'Verified email') }}
            {{ Form::checkbox('verified', true, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create a user', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
