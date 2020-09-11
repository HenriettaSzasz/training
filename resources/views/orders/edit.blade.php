@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach

        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Edit user {{$order->name}}</h1>
            <a class="btn btn-danger pull-left " href="{{ route('orders.index') }}">Back</a>
        </div>

        {{ Form::model($order, array('route' => array('orders.update', $order->id), 'method' => 'PUT')) }}

        @csrf

        <div class="form-group">
            {{ Form::label('details', 'Details') }}
            {{ Form::text('details', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('user_id', 'User') }}
            {{ Form::select('user_id', $users, Request::old('user_id'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Edit order', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection
