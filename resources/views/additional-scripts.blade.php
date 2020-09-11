@section('additional-scripts')

    <script>
        function removeFromCart(id) {
            $.ajax({
                url: '/remove-from-cart/' + id,
                method: 'GET',
                success: function (data) {
                    location.reload()
                }
            })
        }

        function subtract(id) {
            $.ajax({
                url: '/subtract-from-cart/' + id,
                method: 'GET',
                success: function () {
                    location.reload()
                }
            })
        }

        function addToCart(id) {
            $.ajax({
                url: '/add-to-cart/' + id,
                method: 'GET',
                done: function (data) {
                    console.log(data)
                }
            })
            openSlider()
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

        function downArrow(current) {
            current.parentNode.parentNode.querySelector('input[type=number]').stepDown()
        }

        function upArrow(current, id) {
            current.parentNode.parentNode.querySelector('input[type=number]').stepUp()

            $.ajax({
                url: '/add-to-cart/' + id,
                method: 'GET',
                success: function () {
                    location.reload()
                }
            })
        }
    </script>

@endsection
