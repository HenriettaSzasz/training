@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2 justify-content-end">
            <a class="btn btn-danger" href="{{ route('products') }}">Back</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="/images/{{$product->img}}"
                     class="img-fluid z-depth-1">
            </div>
            <div class="col-md-6">
                <h3 class="mb-0">{{$product->name}}</h3>
                <p class="mb-2 text-muted text-uppercase small">{{$product->category->name}}</p>
                <p><span class="mr-1"><strong>{{$product->price}} &euro;</strong></span></p>
                <hr>
                <p>{{$product->description}}</p>
                <hr>
                <div>
                    <div class="row ml-1">
                        <div><i onclick="downArrow(this)"
                                class="fa fa-minus"></i>
                        </div>
                        <input disabled class="count" min="1" name="quantity" value="1" type="number" id="quantity-no">
                        <div>
                            <i onclick="upArrow(this)"
                               class="fa fa-plus"></i>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning btn-md mr-1 mt-2"
                            onclick="addToCart({{$product->id}}, this.parentNode.parentNode.querySelector('input[type=number]').getAttribute('value'))"><i
                            class="fa fa-shopping-cart pr-2"></i>Add to cart
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

@include('customer.slider')


@push('additional-style')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        .count {
            color: #495057;
            border: 0;
            width: 25px;
            background-color: transparent;
            font-size: larger;
            text-align: end;
        }

        i.fa-plus, i.fa-minus {
            color: #495057;
            padding: .5rem;
            font-size: larger;
            cursor: pointer;
        }

        i.fa-plus:hover, i.fa-minus:hover {
            color: #2fa360;
        }
    </style>
@endpush

@push('additional-scripts')
    <script>
        function downArrow(current) {
            if($(current.parentNode.parentNode.querySelector('input[type=number]')).attr('value') > 1)
                $(current.parentNode.parentNode.querySelector('input[type=number]')).attr('value', +$(current.parentNode.parentNode.querySelector('input[type=number]')).attr('value') - 1)
        }

        function upArrow(current) {
            $(current.parentNode.parentNode.querySelector('input[type=number]')).attr('value', +$(current.parentNode.parentNode.querySelector('input[type=number]')).attr('value') + 1)
        }
    </script>
@endpush
