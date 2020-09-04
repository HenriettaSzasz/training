@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Collective\Html\HtmlFacade::ul($errors->all()) }}

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Edit user {{$user->name}}</h1>
            <a class="btn btn-danger pull-left " href="{{ route('users.index') }}">Back</a>
        </div>

        {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email',null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('verified', 'Verified email') }}
            {{ Form::checkbox('verified', true, array('class' => 'form-control', 'disabled')) }}
        </div>

        {{ Form::submit('Edit user', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
