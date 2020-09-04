@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Collective\Html\HtmlFacade::ul($errors->all()) }}

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Edit user {{$category->name}}</h1>
            <a class="btn btn-danger pull-left " href="{{ route('categories.index') }}">Back</a>
        </div>

        {{ Form::model($category, array('route' => array('categories.update', $category->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('briefing', 'Briefing') }}
            {{ Form::text('briefing', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Edit category', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
