<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-Furniture's</title>
    <link href="{{ asset('users/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('users/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('users/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('users/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('users/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('users/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('users/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/users/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/users/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/users/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/users/images/ico/apple-touch-icon-57-precomposed.png">
	<style>
    .red{
        background:#d2322d;
    }
	</style>
    @yield('js_atas')
    @yield('css')

</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
<!--	
					<div class="col-sm-4" style="padding-top:10px;">
						<div class="search_box">
							<input type="text" placeholder="Search"/>
						</div>
					</div>-->
					
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo pull-left">
							<a href="/"><img src="/users/images/home/logo2.png" alt="" /></a>
						</div>
					</div>

					<div class="col-sm-10" style="padding-top:15px;">
						<div class="shop-menu pull-right">
							<ul>
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-list"></span> Tender</a>
                                </li>

								<li>
								
									<a href="/user/wishlist"><i class="fa fa-star"></i> Wishlist 
									
                                	@if(Auth::user())
                                    	@if(auth()->user()->wishlist != null)
									<span class="badge red">
										{{ auth()->user()->wishlist->count() }}
									</span>
										@endif
									@endif
									</a>
								</li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if (Auth::guest())
                                <li>
                                    <a href="/login">
                                        <span class="fa fa-lock"></span> Masuk
                                    </a>
                                </li>
                            @else
                                @if(Auth::user())
                                    <li class="dropdown">
                                        @if(auth()->user()->usaha != null)
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                <span class="glyphicon glyphicon-home" style="color:#d2322d">
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="/user/usaha">
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
                                                <a href="/user/buka_usaha">
                                                    Buka Usaha
                                                </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <i class="fa fa-account"></i> {{ Auth::user()->nama }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="/user/dashboard">
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
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->	
	
	<section>
		<div class="container">
            @yield('content')
		</div>
    </section>
		
	<footer id="footer"><!--Footer-->
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2017 E-FURNITURE's.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">e-Furniture</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

  
    <script src="{{ asset('users/js/jquery.js') }}"></script>
	<script src="{{ asset('users/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('users/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('users/js/price-range.js') }}"></script>
    <script src="{{ asset('users/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('users/js/main.js') }}"></script>
    @yield('js')

</body>
</html>