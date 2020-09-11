@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-xl-inline-flex p-2 justify-content-xl-start align-items-center">
            <h1 class="mr-4">All Products</h1>
            <div><a class="btn btn-danger" href="{{ route('products.create') }}">Create new products</a></div>
        </div>
        {{$dataTable->table()}}
    </div>
@endsection

@push('additional-scripts')
    {!! $dataTable->scripts() !!}
@endpush
