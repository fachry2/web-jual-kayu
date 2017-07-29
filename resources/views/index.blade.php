@extends('layouts.app-user')
@section('css')
    @yield('css_in')
@endsection
@section('content')
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

    @yield('data_menu')

</div>
@endsection

@section('js')    
    @yield('javascript')
@endsection