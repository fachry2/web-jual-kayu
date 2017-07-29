@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="thumbnail">
                <h3>MENU</h4>
                    <div class="panel-body">
                        <ul>
                            @foreach($kategori as $ktg)
                            <li>
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$ktg->id}}" aria-expanded="true" aria-controls="collapseOne">
                                {{ $ktg->kategori }}
                                </a>
                            </li>
                            @endforeach
                            <li>
                                <a href="/produk/cari/all">Semua Produk</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <nav class="list-group">
                    <ul class="nav nav-pills nav-stacked">
                        <li id="dashboard"><a href="/user/dashboard" class="list-group-item"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
                        <li id="pesanan_produk"><a href="/user/pesanan_produk" class="list-group-item"><span class="glyphicon glyphicon-home"></span> Pesanan Saya</a></li>
                        <li id="pemesan_tender"><a href="/user/pesanan_tender" class="list-group-item"><span class="glyphicon glyphicon-home"></span> Pesanan Tender</a></li>
                        <li id="wishlist"><a href="/user/wishlist" class="list-group-item"><span class="glyphicon glyphicon-home"></span> Wishlist</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-9">
                @yield('menu')
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>

        $('document').ready(function () {
            $("nav ul li").click(function () {
//                alert('Ada');
                var id = $(this).attr("id");
                console.log(id)
                $(id).siblings().find(".active").removeClass("active");
                $(id).addClass("active");
                localStorage.setItem("selectedolditem", id);
            });

            var selectedolditem = localStorage.getItem('selectedolditem');

            if (selectedolditem != null) {
                $('#' + selectedolditem).siblings().find(".active").removeClass("active");
                $('#' + selectedolditem).addClass("active");
            }
        });
    </script>
    
    @yield('javascript')
@endsection