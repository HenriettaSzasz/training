@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-sm-between align-items-sm-center">
            <h1>Showing order</h1>
            <a class="btn btn-danger pull-left " href="{{ route('orders.index') }}">Back</a>
        </div>

        <div class="jumbotron text-center">
            <h2>{{ $order->user->name }}'s order</h2>
            <p>
                <strong>Details:</strong> {{ $order->details }}<br>
            </p>
        </div>

    </div>
@endsection
