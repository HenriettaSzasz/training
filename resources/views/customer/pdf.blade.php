<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order details</title>
</head>
<body>
<div class="container">
    <h3 class="text-uppercase">Order no. {{$order->id}}</h3>

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
</body>
</html>
