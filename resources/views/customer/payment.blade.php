@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/charge" method="post">
            <div class="form-row">
                <input class="form-control" id="cardholder-name" type="text">
                <label for="cardholder-name">
                    Full name
                </label>
            </div>
            <div class="form-row">
                <div id="card-element" class="form-control"></div>
                <label for="card-element">
                    Credit or debit card
                </label>
            </div>
            <div id="card-errors" role="alert"></div>

            <button id="card-button" class="btn btn-danger mt-5 pull-right" data-id="{{$id}}" data-secret="{{$intent->client_secret}}">Finish payment
            </button>
        </form>
    </div>
@endsection

@push('additional-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_51HRCQqCXwYAEODPJ0YXjMwlIWUoR3avhW9qA9ltp8MUCE01gj4grVSXz0f35udEqFF8kWpeUjH9t5797Dx9nxwAQ00LCIvxRuv')

        var elements = stripe.elements()
        var cardElement = elements.create('card')

        cardElement.mount('#card-element')


        var cardHolderName = document.getElementById('cardholder-name')
        var cardButton = document.getElementById('card-button')
        var clientSecret = cardButton.getAttribute('data-secret')

        cardButton.addEventListener('click', function (ev){
            ev.preventDefault();
            stripe.handleCardPayment(
                clientSecret, cardElement, {
                    payment_method_data : {
                        billing_details : {
                            name : cardHolderName.value
                        }
                    }
                }
            ).then(function (result){
                if (result.error){
                    console.log(result)
                }
                else {
                    location.href = '/confirm-payment/' + ev.target.getAttribute('data-id')
                }
            })
        })

    </script>
@endpush
