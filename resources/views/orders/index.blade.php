@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start align-items-sm-center">
            <h1 class="mr-4">All Orders</h1>
            <div><a class="btn btn-danger" href="{{ route('orders.create') }}">Create new orders</a></div>
        </div>
        {{$dataTable->table()}}
    </div>
@endsection

@push('additional-scripts')
    {!! $dataTable->scripts() !!}
@endpush
