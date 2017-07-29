@extends('layouts.app-user')
@section('css')
<style>
    .navigasi-border{
        border-block-end:dashed 1px #b8babc;
    }
    .panel-options{
        float: right;
        
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
    
    <div class="left-sidebar">
        <h2>PROFILE USAHA</h2>
        <div class="panel-group category-products" id="accordian">
            <div class="panel panel-default">
            
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
                <div class="panel-heading">
                    <div class="foto" align="center">
                        <img src="/profil_usaha/{{ auth()->user()->usaha->foto }}" alt="" class="img-circle" style="width: 30%;">
                    </div>
                    <h2 class="panel-title" align="center" style="margin-top:10px; margin-bottom:0px;"><a href="#">{{ auth()->user()->usaha->nama_usaha }}</a></h2>
                    <div class="panel" style="padding:0px;" align="center">
                        <h5><a href="/user">{{ auth()->user()->nama }}</a></h5>                      
                    </div>
                </div>
                
                <div class="ratings" align="center">
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        4.0 stars
                    </p>

                    <p>3 reviews</p>
                </div>
            </div>
        </div>
    </div>
        <div class="sidebar content-box" style="display: block;">
            <ul class="nav">
                <!-- Main menu -->
                @if(auth()->user()->usaha->notifikasi->where('read','=',0)->count()!=0)
                <li class="navigasi-border"><a href="/user/usaha/notifikasi"><i class="glyphicon glyphicon-bullhorn"></i> Nofitikasi  <span class="badge pull-right red">{{auth()->user()->usaha->notifikasi->where('read','=',0)->count()}} Belum Dibaca</span></a></a></li>
                @else
                <li class="navigasi-border"><a href="/user/usaha/notifikasi"><i class="glyphicon glyphicon-bullhorn"></i> Nofitikasi</a></a></li>
                @endif
                <li class="current navigasi-border"><a href="/user/usaha/produk"><i class="glyphicon glyphicon-list-alt"></i> Produk Saya <span class="pull-right">({{ auth()->user()->usaha->produk->count() }})</span></a></li>
                <li class="navigasi-border"><a href="/user/usaha/tambah_produk"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah Produk</a></li>
                <li class="navigasi-border"><a href="/user/usaha/pemesanan"><i class="glyphicon glyphicon-bell"></i> Pemesanan</a></li>
                <li class="navigasi-border"><a href="/user/usaha/konfrm_pengiriman"><i class="glyphicon glyphicon-list"></i> Konfirmasi Pengiriman</a></li>
                <li class="navigasi-border"><a href="/user/usaha/tender"><i class="glyphicon glyphicon-comment"></i> Lihat Tander</a></li>
                <li class="navigasi-border"><a href="/user/usaha/pesan"><i class="glyphicon glyphicon-send"></i> Chat</a></li>
            </ul>
        </div>
    </div>

    
    <div class="col-md-9">
    @yield('menu')
    </div>

</div>
<br>
@endsection


@section('js')
    @yield('javascript')
@endsection