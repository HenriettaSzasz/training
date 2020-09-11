@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!empty($products))
            <div id="products">
                <h2 class="font-weight-bold mb-4 mt-1">CHECKOUT</h2>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-uppercase">1. Your products</th>
                        <th scope="col" class="text-uppercase">Quantity</th>
                        <th scope="col" class="text-uppercase">Price</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product['name']}}</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <input class="mr-3 ml-2 quantity_no" type="number" min=0
                                           value={{$product['quantity']}} />
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ml-1 border rounded border-dark pl-2 pr-2 fa fa-angle-up"
                                           onclick="upArrow(this, {{$product['id']}})"></i>
                                        <i class="ml-1 border rounded border-dark pl-2 pr-2 fa fa-angle-down"
                                           onclick="downArrow(this, {{$product['id']}})"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span class="price_no">{{$product['price']}}&euro;</span></td>
                            <td>
                                <button class="btn btn-dark" onclick="removeFromCart(this, {{$product['id']}})">Remove
                                    item
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="font-weight-bold" id="totalprice">
                    <p class="text-uppercase">Total: <span id="total_no">{{$total}}&euro;</span></p>
                </div>
            </div>

            {{ Form::model(Auth::user(), array('route' => 'place-order', 'method' => 'GET', 'id' => 'cart-form')) }}
            @csrf

            <div class="mb-3" id="billing">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-uppercase">2. Billing address</th>
                    </tr>
                    </thead>
                </table>

                <div class="form-group">
                    {{ Form::label('name', 'Username') }}
                    {{ Form::text('name', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="form-group">
                    {{ Form::label('first', 'First Name') }}
                    {{ Form::text('first', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="form-group">
                    {{ Form::label('last', 'Last Name') }}
                    {{ Form::text('last', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email',null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" disabled>
                            <option value="">Choose...</option>
                            <option>United States</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" disabled>
                            <option value="">Choose...</option>
                            <option>California</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" disabled>
                    </div>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                        address</label>
                </div>

            </div>

            <div id="shipping">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-uppercase">3. Shipping</th>
                    </tr>
                    </thead>
                </table>

                <div class="form-group">
                    {{ Form::label('first', 'First Name') }}
                    {{ Form::text('first', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="form-group">
                    {{ Form::label('last', 'Last Name') }}
                    {{ Form::text('last', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', null, array('class' => 'form-control', 'disabled' => true)) }}
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" disabled>
                            <option value="">Choose...</option>
                            <option>United States</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" disabled>
                            <option value="">Choose...</option>
                            <option>California</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" disabled>
                    </div>
                </div>
            </div>

            <div id="payment">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-uppercase" id="toggle-payment">4. Payment</th>
                    </tr>
                    </thead>
                </table>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked>
                        <label class="custom-control-label" for="credit">Cash on delivery</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" disabled>
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" disabled>
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" disabled>
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" disabled>
                        <small class="text-muted">Full name as displayed on card</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" disabled>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        @else
            <div class="m-5 d-flex justify-content-center align-items-end">
                <h3 class="m-5">Your cart is empty</h3>
            </div>
        @endif
        <div id="checkout-buttons">
            <div class="d-flex justify-content-between">
                <button class="btn btn-secondary" onclick="location.href='{{route('products')}}'">Back to shopping
                </button>
                <button class="btn btn-light" onclick="document.getElementById('cart-form').submit(); ">Continue<i class="pl-2 fa fa-angle-double-right"></i></button>
            </div>
        </div>
    </div>
@endsection

@push('additional-style')
    <style>
        #checkout-buttons {
            position: relative;
            bottom: 5%;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        .quantity_no {
            color: #495057;
            border: 0;
            width: 25px;
            background-color: transparent;
            font-size: larger;
            text-align: end;
        }

        i.fa:hover {
            cursor: pointer;
            background: dimgray;
            transition: 0.5s;
        }
    </style>

@endpush

@push('additional-scripts')
    <script>
        $('#same-address').change(function () {
            if ($(this).is(':checked')) {
                $('#shipping').hide()
                $('#toggle-payment').text('3. Payment')
            } else {
                $('#shipping').show()
                $('#toggle-payment').text('4. Payment')
            }
        })

        function add(current, id) {
            $.ajax({
                url: '/add-to-cart/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    let updated = 0;
                    $.each(data.products, function (key, product) {
                        if (product.id === id) {
                            update(product, current, -1)
                            updated = 1;
                        }
                    })
                    if (!updated) {
                        location.reload()
                    }
                }
            })
        }

        function subtract(current, id) {
            $.ajax({
                url: '/subtract-from-cart/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    let updated = 0;
                    $.each(data.products, function (key, product) {
                        if (product.id === id) {
                            update(product, current, 1)
                            updated = 1;
                        }
                    })
                    if (!updated) {
                        location.reload()
                    }
                }
            })
        }

        function removeFromCart(current, id) {
            $.ajax({
                url: '/remove-from-cart/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    location.reload()
                }
            })
        }

        function upArrow(current, id) {
            current.parentNode.parentNode.querySelector('input[type=number]').stepUp()

            add(current, id)
        }

        function downArrow(current, id) {
            current.parentNode.parentNode.querySelector('input[type=number]').stepDown()

            subtract(current, id)
        }

        function update(data, self, old) {
            if (data.quantity > 0) {
                const $price_no = $(self).closest('td').next().find('.price_no')
                const $quantity_no = $(self).closest('td').find('.quantity_no')
                const old_price = +$price_no.text().substring(0, $price_no.text().length - 1)

                const price = old_price / (data.quantity + old)
                const new_price = data.quantity * price
                const diff = new_price - old_price


                $quantity_no.val(data.quantity)
                $price_no.html(new_price + '&euro;')
                $('#total_no').html(+$('#total_no').text().substr(0, $('#total_no').text().length - 1) + diff + '&euro;')
            }
        }
    </script>
@endpush
