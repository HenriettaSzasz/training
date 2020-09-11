@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($orders) == 0)
            <div class="m-5 d-flex justify-content-center align-items-end">
                <h3 class="m-5">You don't have any recent orders</h3>
            </div>
        @else
            <h3 class="text-uppercase">Order history</h3>

            <table class="table table-sm table-bordered table-light table-hover">
                <thead>
                <tr>
                    <th>Order no.</th>
                    <th>Details</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->details}}</td>
                        <td><a class="text-decoration-none" href="{{route('order-details', $order->id)}}">See more
                                details</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
