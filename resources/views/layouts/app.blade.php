<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @auth
            <div id="datablock" style="display: none;" 
                data-api_token="{{ Auth::user()->api_token }}"
                data-base_url="{{ env('APP_URL') }}"></div>
        @endauth
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <img src="{{ asset('img/logo.png') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Right Side Of Navbar -->
                        <ul class="main-nav">
                            <!-- Authentication Links -->
                            @guest
                                <li>
                                    <a href="https://www.acaciaguitars.com">Main Site</a>
                                </li>
                            @else
                                <li>
                                    <a href="/" class="{{ $page == 'form' ? 'is-active' : '' }}">Form</a>
                                </li>
                                <li>
                                    <a href="{{ route('orders') }}" class="{{ $page == 'orders' ? 'is-active' : '' }}">Orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('attributes') }}" class="{{ $page == 'attributes' ? 'is-active' : '' }}">Attributes</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <div id="ajax_msg_list" class="ajax_msg_list"></div>

    </div>
</body>
</html>
