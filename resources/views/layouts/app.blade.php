<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!--    <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>Furniture</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                <!-- {{ config('app.name', 'Laravel') }}-->
                    Jual Furniture
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <div class="input-group" style="padding-top:10px;">
                            <input type="text" class="form-control" aria-label="Cari" style="widht:600px; min-width:450px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Kategori <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#">Semua Kategori</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Sofa</a></li>
                                    <li><a href="#">Tempat Penyimpanan</a></li>
                                    <li><a href="#">Meja dan Kursi</a></li>
                                </ul>
                                <button type="button" class="btn btn-danger">Cari</button>
                            </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="pull-right btn"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge">0</span></a>
                    </li>
                </ul>
                    <!-- Authentication Links -->
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li>
                                <a href="#">
                                    <span class="glyphicon glyphicon-list"></span> Tender</a>
                            </li>

                            <li>
                                <a href="/login">
                                    <span class="glyphicon glyphicon-user"></span> Masuk | Daftar</a>
                            </li>
                        @else
                            @if(Auth::user())<!--PENJUAL-->

                                <li class="dropdown">
                                    @if(auth()->user()->usaha != null)
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span class="glyphicon glyphicon-home"></span> <span class="badge">0</span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="/user/usaha" class="btn btn-success">
                                                    {{ auth()->user()->usaha->nama_usaha }}
                                                </a>
                                            </li>
                                        </ul>
                                    @else
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span class="glyphicon glyphicon-home"></span>
                                        </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                            <a href="/user/buka_usaha" class="btn btn-danger">
                                                Buka Usaha
                                            </a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->nama }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="/user/dashboard
                                            ">
                                                Ruangan Pembeli
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/logout"
                                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                    </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.maskMoney.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@yield('js')

</body>
</html>
