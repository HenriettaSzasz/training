@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>All Orders</h1>
            <a class="btn btn-danger pull-left " href="{{ route('orders.create') }}">Create new orders</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Details</td>
                <td>User</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->details }}</td>
                    <td>{{ $value->user->name }}</td>

                    <td>
                        {{ Form::open(array('route' => array('orders.destroy', $value->id), 'class' => 'pull-right')) }}
                        @csrf
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete this order', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}

                        <a class="btn btn-small btn-success" href="{{ route('orders.show', $value->id ) }}">Show</a>

                        <a class="btn btn-small btn-info"
                           href="{{ route('orders.edit', $value->id ) }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
