@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Collective\Html\HtmlFacade::ul($errors->all()) }}

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Add a new product</h1>
            <a class="btn btn-danger pull-left " href="{{ route('products.index') }}">Back</a>
        </div>

        {{ Form::open(array('route' => 'products.store')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('units', 'Units') }}
            {{ Form::text('units', Request::old('units'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('price', 'Price') }}
            {{ Form::text('price', Request::old('price'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Request::old('description'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('category_id', 'Category') }}
            {{ Form::select('category_id', $categories, Request::old('category_id'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create a product', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
