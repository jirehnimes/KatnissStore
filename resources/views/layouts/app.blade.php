<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Katniss Store</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap-theme.min.css') }}">

    <!-- Slick.js -->
    <link rel="stylesheet" href="{{ asset('slick-1.6.0/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick-1.6.0/slick/slick-theme.css') }}">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

    <!-- Slick.js -->
    <script src="{{ asset('slick-1.6.0/slick/slick.min.js') }}"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .modal {
            border-radius: 0;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            if (typeof(Storage) !== 'undefined') {
                if (sessionStorage.cart) {
                    sCart = JSON.parse(sessionStorage.cart);
                    $('#app-layout .nav.navbar-nav .cartCnt').text(sCart.length);
                }
            } else {
                console.error('No web localstorage in this browser.');
            }
        });
    </script>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header" >

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Katniss Store
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @foreach ($aCats as $aCat)
                        <li><a href="{{ url('/products/'.$aCat->name) }}">{{ $aCat->name }}</a></li>
                    @endforeach
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <hr>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="" data-toggle="modal" data-target="#cartModal"><i class="fa fa-btn fa-shopping-cart"></i><span class="cartCnt">0</span></a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="" data-toggle="modal" data-target="#loginModal">Login/Register</a></li>
                    @else
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                            </ul>
                        </li> -->
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    @endif
                </ul>

                <!-- <form class="navbar-form navbar-right">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </nav>

    <section id="content">
        @yield('content')
    </section>

    <footer>
        <center>
            Katniss Store 2017
        </center>
    </footer>

    @include('layouts.modal.login')
    @include('layouts.modal.cart')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
