@section('additional-style')
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
@endsection
