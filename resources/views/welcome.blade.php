@extends('layouts.app-user')
@section('css')
    @yield('css_in')
@endsection
@section('content')
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
						<li data-target="#slider-carousel" data-slide-to="3"></li>
					</ol>
					
					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>e</span>-FURNITURE'S</h1>
								<h2>Free E-Commerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Beli</button>
							</div>
							<div class="col-sm-6">
								<img src="/users/images/slide/1.jpg" class="girl img-responsive" alt="" />
								<img src="/users/images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>e</span>-FURNITURE'S</h1>
								<h2>100% Responsive Design</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Beli</button>
							</div>
							<div class="col-sm-6">
								<img src="/users/images/slide/2.jpg" class="girl img-responsive" alt="" />
								<img src="/users/images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>
						
						<div class="item">
							<div class="col-sm-6">
								<h1><span>e</span>-FURNITURE'S</h1>
								<h2>Free Ecommerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Beli</button>
							</div>
							<div class="col-sm-6">
								<img src="/users/images/slide/3.png" class="girl img-responsive" alt="" />
								<img src="/users/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>
						
						<div class="item">
							<div class="col-sm-6">
								<h1><span>e</span>-FURNITURE'S</h1>
								<h2>Free Ecommerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Beli</button>
							</div>
							<div class="col-sm-6">
								<img src="/users/images/slide/4.jpg" class="girl img-responsive" alt="" />
								<img src="/users/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>
						
					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/slider-->

<div class="row">
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Category</h2>
            <div class="panel-group category-products" id="accordian">
			@foreach(App\KategoriProduk::all() as $kategori)
                <!--category-productsr-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/produk/kategori/{{ $kategori->id }}">{{ $kategori->kategori }}</a></h4>
                    </div>
                </div>
			@endforeach
			<hr>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/">Semua Kategori</a></h4>
                    </div>
                </div>
            </div><!--/category-products-->
        </div>
    </div>
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        <?php
            $i=0;
        ?>
        @foreach($produk as $pr)
        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="/gambar_produk/{{ $pr->foto }}" alt="" height="150">
                            <h4>{{$pr->nama_produk}}</h4>
                            <p>Rp. {{$pr->harga}}</p>
                            @if(Auth::user() && auth()->user()->usaha)
                                @if($pr->id_usaha == auth()->user()->usaha->id)
                                <a href="#" class="btn btn-default add-to-cart"><span class="label label-warning pull-center">Your Produk</span></a>
                                @else
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                                @endif
                            @elseif(Auth::user() && !auth()->user()->usaha)
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                            @else
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                            @endif
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{$pr->nama_produk}}</h2>
                                <p><b>Rp. {{$pr->harga}}</b></p>
                                @if(Auth::user() && auth()->user()->usaha)
                                    @if($pr->id_usaha != auth()->user()->usaha->id)
                                    <a href="/produk/{{ $pr->id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                                    @endif
                                @elseif(Auth::user() && !auth()->user()->usaha)
                                    <a href="/produk/{{ $pr->id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                                @else
                                    <a href="/produk/{{ $pr->id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li>
                            @if(Auth::user())
                                @if(auth()->user()->usaha)
                                    @if($pr->id_usaha == auth()->user()->usaha->id)
                                        <a href="/user/usaha/produk/{{$pr->id}}/edit" class="btn btn-default" style="margin-bottom:0px; float:left; width:100%; background:#5cb85c; color:#fff;"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn btn-default" style="margin-bottom:0px; float:right; width:100%; background:#d2322d; color:#fff"><i class="glyphicon glyphicon-trash"></i>Hapus</a>
                                        </li>
                                    @else
                                        <?php
                                            $status = 0;
                                        ?>
                                        @if(Auth::user()->wishlist->count() != 0)
                                            @foreach(auth()->user()->wishlist as $wishlist)
                                                @if($pr->id == $wishlist->id_produk)
                                                    <?php
                                                        $status = $wishlist->id;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if($status!=0)
                                                <form  method="POST" action="/user/produk/delete_wishlist">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{ $status }}" name="id">
                                                    <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="fa fa-heart" style="color:red;"></i>Wishlist</button>
                                                </form>
                                            @else
                                                <form  method="POST" action="/user/produk/add_to_wishlist">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="id_produk" value="{{ $pr->id }}">
                                                <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="glyphicon glyphicon-heart-empty"></i>Wishlist</button>
                                                </form>
                                            @endif
                                        @else
                                            <form  method="POST" action="/user/produk/add_to_wishlist">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="id_produk" value="{{ $pr->id }}">
                                            <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="glyphicon glyphicon-heart-empty"></i>Wishlist</button>
                                            </form>
                                        @endif
                                        </li>
                                            <li>
                                                <form method="GET" action="/produk/{{$pr->id}}">
                                                    <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:right; width:100%;"><i class="glyphicon glyphicon-shopping-cart"></i>Beli</button>
                                                </form>
                                            </li>
                                    @endif
                                @else
                                    <?php
                                        $status = 0;
                                    ?>
                                    @if(Auth::user()->wishlist->count() != 0)
                                        @foreach(auth()->user()->wishlist as $wishlist)
                                            @if($pr->id == $wishlist->id_produk)
                                                <?php
                                                    $status = $wishlist->id;
                                                ?>
                                            @endif
                                        @endforeach
                                        @if($status!=0)
                                            <form  method="POST" action="/user/produk/delete_wishlist">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $status }}" name="id">
                                                <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="fa fa-heart" style="color:red;"></i>Wishlist</button>
                                            </form>
                                        @else
                                            <form  method="POST" action="/user/produk/add_to_wishlist">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="id_produk" value="{{ $pr->id }}">
                                            <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="glyphicon glyphicon-heart-empty"></i>Wishlist</button>
                                            </form>
                                        @endif
                                    @else
                                        <form  method="POST" action="/user/produk/add_to_wishlist">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="id_produk" value="{{ $pr->id }}">
                                        <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="glyphicon glyphicon-heart-empty"></i>Wishlist</button>
                                        </form>
                                    @endif
                                    </li>
                                        <li>
                                            <form method="GET" action="/produk/{{$pr->id}}">
                                                <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:right; width:100%;"><i class="glyphicon glyphicon-shopping-cart"></i>Beli</button>
                                            </form>
                                        </li>
                                @endif
                            @else
                            <form  method="GET" action="/login">
                                <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:left; width:100%;"><i class="fa fa-heart"></i>Wishlist</button>
                            </form>
                        </li>
                        <li>
                            <form method="GET" action="/produk/{{$pr->id}}">
                                <button type="submit" class="btn btn-default add-to-cart" style="margin-bottom:0px; float:right; width:100%;"><i class="glyphicon glyphicon-shopping-cart"></i>Buy</button>
                            </form>
                        </li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        
    </div><!--features_items-->
    
</div>
@endsection