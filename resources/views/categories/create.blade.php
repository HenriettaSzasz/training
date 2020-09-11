@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Add a new category</h1>
            <a class="btn btn-danger pull-left " href="{{ route('categories.index') }}">Back</a>
        </div>

        {{ Form::open(array('route' => 'categories.store')) }}
        @csrf

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('briefing', 'Briefing') }}
            {{ Form::text('briefing', Request::old('briefing'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create a category', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
