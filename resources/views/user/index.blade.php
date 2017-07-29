@extends('layouts.app-user')
@section('js_atas')
    @yield('js_up')
@endsection
@section('css')
<style>
    .navigasi-border{
        border-block-end:dashed 1px #b8babc;
    }
    .panel-options{
        float: right;
        
    }
    .well{
        background-color:#F5F5F5
    }

    li.current > a{
        background: #243;
        color: #fff;
        border-bottom: 0px
    }
</style>
    @yield('css_in')
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
    
    <div class="left-sidebar">
        <h2>PROFILE</h2>
        <div class="panel-group category-products" id="accordian">
            <div class="panel panel-default">
            
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
                <div class="panel-heading">
                    <div class="foto" align="center">
                        <img src="/profil_usaha/54806.jpg" alt="" class="img-circle" style="width: 30%;">
                    </div>
                    <h2 class="panel-title" align="center" style="margin-top:10px; margin-bottom:0px;"><a href="#">{{ auth()->user()->nama }}</a></h2>
                    <div class="panel" style="padding:0px;" align="center">
                        <h5><a href="#">{{ auth()->user()->username }}</a></h5>
                        <h7><a>{{ auth()->user()->email }}</a></h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="sidebar content-box" style="display: block;">
            <ul class="nav">
                <!-- Main menu -->
                <li class="current navigasi-border"><a href="/user/dashboard/"><i class="glyphicon glyphicon-list-alt"></i> Dashboard</a></li>
                <li class="navigasi-border"><a href="/user/pesanan"><i class="glyphicon glyphicon-shopping-cart"></i> Pesanan Saya</a></li>
                <li class="navigasi-border"><a href="/user/pesan/tender"><i class="glyphicon glyphicon-bell"></i> Pesan Tender</a></li>
                @if(auth()->user()->wishlist->count() > 0)
                <li class="navigasi-border"><a href="/user/wishlist"><i class="glyphicon glyphicon-list"></i> Wishlist <span class="badge pull-right red">{{ auth()->user()->wishlist->count() }}</span></a></li>
                @else
                <li class="navigasi-border"><a href="/user/wishlist"><i class="glyphicon glyphicon-list"></i> Wishlist</a></li>
                @endif
                <li class="navigasi-border"><a href="/user/ualasan"><i class="glyphicon glyphicon-comment"></i> Berikan Ulasan</a></li>
                <li class="navigasi-border"><a href="/user/chat"><i class="glyphicon glyphicon-send"></i> Chat</a></li>
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
    @yield('js_in')
@endsection