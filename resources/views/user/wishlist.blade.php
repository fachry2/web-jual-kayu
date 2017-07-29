@extends('user.index')

@section('menu')
<div class="well">
    <div class="text-left">
        <h3>WISHLIST</h3>        
        <div class="features_items"><!--features_items-->
            @foreach(auth()->user()->wishlist as $wish)
            <?php $dataProduk = App\Produk::find($wish->id_produk); ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper" style="background:#fff;">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="/gambar_produk/{{ $dataProduk->foto }}" alt="" height="150" />
                            <h2>Rp. {{ $dataProduk->harga }}</h2>
                            <p>{{ $dataProduk->nama_produk }}</p>
                        </div>
                    </div>
                    <div class="newarrival">
                        <form  method="POST" action="/user/produk/delete_wishlist">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $wish->id }}" name="id">
                            <button type="submit" style="background:none; border:none; font-size:200%;">
                                <i class="fa fa-heart" style="color:red;"></i>
                            </button>
                        </form>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li>
                                <form method="GET" action="/produk/{{$dataProduk->id}}">
                                    <button type="submit" class="btn add-to-cart" style="margin-bottom:0px; color:#fff; width:100%; background:#5cb85c;"><i class="glyphicon glyphicon-shopping-cart"></i>Beli</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection