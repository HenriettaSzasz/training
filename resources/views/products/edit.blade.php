@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Edit product {{$product->name}}</h1>
            <a class="btn btn-danger pull-left " href="{{ route('products.index') }}">Back</a>
        </div>

        {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT')) }}
        @csrf

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('units', 'Units') }}
            {{ Form::text('units', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('price', 'Price') }}
            {{ Form::text('price', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('category_id', 'Category') }}
            {{ Form::select('category_id', $categories, null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Edit product', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
