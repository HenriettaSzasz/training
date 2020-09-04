@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>All Products</h1>
            <a class="btn btn-danger pull-left " href="{{ route('products.create') }}">Create new products</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Units</td>
                <td>Price</td>
                <td>Description</td>
                <td>Category</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->units }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{$value->description}}</td>
                    <td>{{$categories[$value->category_id]}}</td>

                    <td>
                        {{ Form::open(array('route' => array('products.destroy', $value->id), 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete this product', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}

                        <a class="btn btn-small btn-success" href="{{ route('products.show', $value->id) }}">Show</a>

                        <a class="btn btn-small btn-info"
                           href="{{ route('products.edit', $value->id ) }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
