@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-stretch">
            <nav class="p-3 mr-2 mt-4 bg-secondary text-info h-100 rounded w-25">
                <div>
                    <h5><a href="{{route('products')}}" class="text-info text-decoration-none">All products</a></h5>
                    <hr>
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <hr>
                        @foreach($categories as $category)
                            <li><a href="{{route('category', $category->id)}}" class="text-light text-decoration-none">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="row align-items-center justify-content-between p-4 w-100">
                @foreach($products as $product)
                    <div class="card overflow-hidden border-secondary ml-2 mb-3 text-center" style="width: 15rem;">
                        <img src="/images/{{$product->img}}"
                             class="card-img-top" alt="card image">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-subtitle mb-2">{{$product->price}} &euro;</p>
                            <a href="{{route('show-products', ['id' => $product->id ])}}"
                               class="btn btn-secondary">Details</a>

                            <button onclick="addToCart({{$product->id}})" type="button" class="btn btn-warning" id="add-to-cart">
                                Add to cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@include('customer.slider')

