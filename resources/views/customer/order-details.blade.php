@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-danger pull-right" href="{{ route('order-history') }}">Back</a>
        <div class="row align-items-start">
            <h3 class="text-uppercase">Order no. {{$order->id}}</h3>
            <a class="btn btn-warning ml-3" href="{{route('create-pdf', $order->id)}}">Download pdf</a>
        </div>

        <table class="table table-sm table-bordered table-light table-hover">
            <thead>
            <tr>
                <th>Products</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $key => $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$order->quantity[$key]->quantity}}</td>
                    <td>{{$item->price}}&euro;</td>
                    <td class="prices">{{$order->quantity[$key]->quantity * $item->price}}&euro;</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p class="text-uppercase font-weight-bold" id="total-price">Order total: {{$order->total}}</p>
    </div>
@endsection
