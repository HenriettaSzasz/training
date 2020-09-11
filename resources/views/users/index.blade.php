@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start align-items-sm-center">
            <h1 class="mr-5">All Users</h1>
            <div><a class="btn btn-danger" href="{{ route('users.create') }}">Create new users</a></div>
        </div>
        {{$dataTable->table()}}
    </div>
@endsection

@push('additional-scripts')
    {!! $dataTable->scripts() !!}
@endpush
