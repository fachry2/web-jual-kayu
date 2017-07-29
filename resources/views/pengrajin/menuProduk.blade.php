@extends('pengrajin.index')

@section('menu')
    
    <div class="well">

        <div class="text-left">
            <h3>Produk Saya</h3>
        </div>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <!--<button type="submit" class="btn btn-default">Submit</button>-->
          </form>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <div class="row">
    <div class="features_items"><!--features_items-->
    @foreach($produks as $produk)
      <div class="col-sm-3">
        @if($produk->status == 0)
            <p style="background-color:#d9534f; color:#fff;">
              Pending...
            </p>
        @else
            <p style="background-color:#449d44; color:#fff;">
              Published
            </p>
        @endif
        <div class="product-image-wrapper">
          <div class="single-products">
              <div class="productinfo text-center">
                <img src="/gambar_produk/{{ $produk->foto }}" alt="" height="150"/>
                <h4>{{$produk->nama_produk}}</h4>
                <p>Rp. {{ $produk->harga }}</p>
              </div>
          </div>
          <div class="choose">
            <ul class="nav nav-pills nav-justified">
              <li><a href="/user/usaha/produk/{{$produk->id}}/edit"><i class="glyphicon glyphicon-edit"></i>Edit</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-trash"></i>Hapus</a></li>
            </ul>
          </div>
        </div>
      </div>
      @endforeach
    </div>
@endsection