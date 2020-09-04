@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Showing product</h1>
            <a class="btn btn-danger pull-left " href="{{ route('products.index') }}">Back</a>
        </div>

        <div class="jumbotron text-center">
            <h2>{{ $product->name }}</h2>
            <p>
                <strong>Units:</strong> {{ $product->units }}<br>
                <strong>Price:</strong> {{ $product->price }}<br>
                <strong>Description:<br></strong> {{ $product->description }}<br>
                <strong>Category:<br></strong> {{ $category->name }}
            </p>
        </div>

    </div>
@endsection
