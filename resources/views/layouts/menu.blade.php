<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link " href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <i class="fa fa-bars" id="menu-icon"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
        @if(Auth::check() && Auth::user()->IsAdmin)
            <div>
                <a class="dropdown-item" href="{{route('users.index') }}"
                   onclick="event.preventDefault();
                 document.getElementById('users-form').submit();">
                    {{ __('Users') }}
                </a>

                <form id="users-form" action="{{ route('users.index') }}" method="GET" class="d-none">
                    @csrf
                </form>
            </div>

            <div>
                <a class="dropdown-item" href="{{route('products.index') }}"
                   onclick="event.preventDefault();
                 document.getElementById('products-form').submit();">
                    {{ __('Products') }}
                </a>

                <form id="products-form" action="{{ route('products.index') }}" method="GET" class="d-none">
                    @csrf
                </form>
            </div>

            <div>
                <a class="dropdown-item" href="{{ route('categories.index') }}"
                   onclick="event.preventDefault();
                 document.getElementById('categories-form').submit();">
                    {{ __('Categories') }}
                </a>

                <form id="categories-form" action="{{ route('categories.index') }}" method="GET" class="d-none">
                    @csrf
                </form>
            </div>

            <div>
                <a class="dropdown-item" href="{{ route('orders.index') }}"
                   onclick="event.preventDefault();
                 document.getElementById('orders-form').submit();">
                    {{ __('Orders') }}
                </a>

                <form id="orders-form" action="{{ route('orders.index') }}" method="GET" class="d-none">
                    @csrf
                </form>
            </div>
        @endif
    </div>
</li>
