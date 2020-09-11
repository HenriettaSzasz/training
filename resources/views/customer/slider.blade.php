<div hidden class="position-fixed h-100 bg-white" id="slider"
     style="width: 0; top: 0; right: 0; padding-top: 50px; transition: 0.5s;">
    <div class="d-flex justify-content-end">
        <a class="text-danger text-decoration-none font-weight-bold h1 p-3" id="close" onclick="hideSlider()"
           style="cursor: pointer">&times;</a>
    </div>

    <h3 class="text-uppercase p-2">Shopping cart</h3>

    <table class="table p-2" id="cart-table">
    </table>

    <div class="text-uppercase p-3" id="cart_total">Total:</div>

    <div class="d-flex flex-column justify-content-end" id="m-buttons">
        <button class="btn btn-light text-uppercase" id="checkout" onclick="location.href='{{route('cart')}}'">
            checkout
        </button>
        <button class="btn btn-dark text-uppercase" id="back"
                onclick="hideSlider(); location.href='{{route('products')}}'">back to shopping
        </button>
    </div>
</div>

@push('additional-scripts')
    <script>
        function addToCart(id, quantity = null) {
            if (quantity !== null) {
                $.ajax({
                    url: '/update-cart/' + id + '/quantity/' + quantity,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data)
                        updateSlider(data)
                    }
                })
            }
            else {
                $.ajax({
                    url: '/add-to-cart/' + id,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data)
                        updateSlider(data)
                    }
                })
            }
            openSlider()
        }

        function removeFromCart(id) {
            $.ajax({
                url: '/remove-from-cart/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    if(data.total === 0)
                        hideSlider()
                    else
                        updateSlider(data)
                }
            })
        }

        function openSlider() {
            $('#slider').attr('hidden', false).css('width', '325px')
            $('#app').css('marginRight', '325px').css('transition', '0.5s')
        }

        function hideSlider() {
            $('#slider').css('width', '0px')
            $('#app').css('marginRight', '0px')
            location.reload()
        }

        function updateSlider(data) {
            $('#cart-table').children().remove()

            if (data.products == null) {
                $('#cart_total').text('Cart is empty')
                return 0;
            }

            let $row = $('<tr>').appendTo($('#cart-table'))

            $('<th>').text('Product').appendTo($row)
            $('<th>').text('Quantity').appendTo($row)
            $('<th>').text('Price').appendTo($row)
            $('<th>').appendTo($row)

            jQuery.each(data.products, function (key, value) {
                $row = $('<tr>').appendTo($('#cart-table'))

                $('<td>').text(value['name']).appendTo($row)
                $('<td>').text(value['quantity']).appendTo($row)
                $('<td>').html(value['price'] + '&euro;').appendTo($row)
                let $remove = $('<td>').appendTo($row)

                $('<a>').addClass('removebtn text-decoration-none').attr({
                    'data-id': value['id'],
                    'onclick': 'removeFromCart(' + value['id'] + ')',
                    'style' : 'cursor: pointer'
                }).html('&times').appendTo($remove)

            })

            $('#cart_total').html('Total: ' + data.total + '&euro;')
        }
    </script>
@endpush
