@extends('layouts.app-admin')
@section('css')
<style>
.merah{
	background:#d9534f;
}
.hijau{
	background: #169F85;
}
</style>
@endsection
@section('content')
	 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Detail Produk</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
			@if(session()->has('message'))
			
			<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
			</button>
			<strong>
        		{{ session()->get('message') }}</strong>
			</div>
			@endif
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
				@if($produk->status == 0)
                  <div class="x_title merah">
				@else
                  <div class="x_title hijau">
				@endif
                    <h2></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="product-image">
                        <img src="/gambar_produk/{{$produk->foto}}" alt="..." />
                      </div>
                      <div class="product_gallery">
					  	@foreach($foto as $gbr)
                        <a>
                          <img src="/gambar_produk/{{$gbr->foto}}" alt="..." />
                        </a>
						@endforeach
                      </div>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
					<div class="prod_title">
						<h3>{{$produk->nama_produk}}</h3>
						<h6><a>{{ $usaha->nama_usaha }}</a></h6>
					</div>

					<p>{{$produk->deskripsi}}</p>
					<br/>
					  
					<h2>Kategori</h2>
					<h5>{{ $kategori->kategori }}</h5>
                    <br/>

					<h2>Ukuran</h2>
					{{ $produk->p }} x {{ $produk->l }} x {{ $produk->t }}
          <br/><br>

					<h2>Jenis Material yang Digunakan</h2>
					<ul>
						<?php
						$materiNull = 0;
						?>
					@foreach($material as $m)
						@if($m->status == 1)
						<li>
						{{ $m->material }}
						</li>
						@else
						<?php $materiNull = 1; ?>
						@endif
					@endforeach
					</ul>
					
					@if($materiNull == 1)
					Material baru ditambah oleh user, perlu persetujuan!
					@endif
					<ul>
					@foreach($material as $m)
						@if($m->status == 0)
						<li style="color:red">
						{{ $m->material }}
						<form action="/admin/material/setuju/" method="post" class="form-inline">
							{{ csrf_field() }}
							<input type="hidden" value="{{$m->id_material}}" name="id_material">
							<input type="hidden" value="{{$usaha->id}}" name="id_usaha">
							<input type="hidden" value="[ADMIN] - Pengajuan Material Diterima" name="judul">
							<input type="hidden" value="Pengajuan material baru <b style='color:red'>{{$m->material}}</b> pada produk <b style='color:red'>{{ $produk->nama_produk }}</b> diterima.<br>" name="pesan">
							<button type="submit" class="btn btn-success btn-xs">Setujui</button>
						</form>

						<form action="/admin/material/tolak/{{$m->id_material}}" method="post" class="form-inline">
							{{ method_field('DELETE') }}
							{{ csrf_field() }}
							<!--<input type="hidden" value="{{$produk->id}}" name="id_produk">-->
							<input type="hidden" value="{{$m->id_material}}" name="id_material">
							<input type="hidden" value="{{$usaha->id}}" name="id_usaha">
							<input type="hidden" value="[ADMIN] - Pengajuan Material Ditolak" name="judul">
							<input type="hidden" value="Pengajuan material baru <b style='color:red'>{{$m->material}}</b> pada produk <b style='color:red'>{{ $produk->nama_produk }}</b>tidak dapat diterima.<br> Anda dapat mengubah dan akan disetujui oleh ADMIN atau menghapus produk anda" name="pesan">
							<button type="submit" class="btn btn-danger btn-xs">hapus</button>
						</form>
						</li>
						@endif
					@endforeach
					</ul>
					<br />

					<h2>Berat</h2>
					{{ $produk->berat }} {{ $produk->satuan_berat }}
                    <br/>

					<h2>Stok</h2>
					{{ $produk->stok }}
					<br/>
					<br/>
					<br/>
					<div class="x_title">
						<h2>Pemilik</h2>
						<div class="clearfix"></div>
					</div>
					<ul class="list-unstyled scroll-view">
						<li class="media event">
						<img src="/profil_usaha/{{$usaha->foto}}" alt="" class="pull-left border-aero profile_thumb" style="width:60px; height:60px; padding:0px; border-radius:30%;">
						<div class="media-body">
							<a class="title" href="#">{{$usaha->nama_usaha}}</a>
							<p><small>by</small><strong> {{$user->nama}} </strong></p>
							<p> <small>{{$usaha->alamat_usaha}}</small>
							<hr>
							<p>							
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
							</p>
						</div>
						</li>
					</ul>

					<div class="">
						<div class="product_price">
							<h1 class="price">Rp. {{ $produk->harga }}</h1>
							<br>
						</div>
					</div>

            <div class="">
							@if($produk->status == 0)
							
								@if($materiNull == 0)
									<button type="button" class="btn btn-default btn-lg btn-danger" data-toggle="modal" data-target="#myModal" style="width:100%;">Pubikasikan</button>
								@else
								<i class="badge merah" style="margin-bottom:10px;">Terdapat material baru yang berlum disetujui, setujui lalu publish</i>
								@endif
							@else
							<button type="button" class="btn btn-default btn-lg btn-success" style="width:100%;">Terpublikasi</button>
							@endif
							<button type="button" class="btn btn-default btn-lg btn-warning">Hapus</button>
							</div>
            </div>
                    <div class="col-md-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                              synth. Cosby sweater eu banh mi, qui irure terr.</p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                              booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

		 <!--MODAL--><!-- Modal -->
    <div id="myModal" class="modal fade bs-example-modal-sm" role="dialog">
        <div class="modal-dialog modal-sm" role="document">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">KONFIRMASI</h4>
                </div>
								<form method="post" action="{{ url('admin/produk/updating') }}">
									<div class="modal-body">
									<div class="form-group">
										<p>
											<h4>Apakah Produk ini layak untuk ditampilkan / dijual ?</h5>
										</p>
										{{ csrf_field() }}
										<input type="hidden" value="{{$produk->nama_produk}}" name="nama_produk">
										<input type="hidden" value="{{$usaha->id}}" name="id_usaha">
										<input type="hidden" value="[ADMIN] - Your produk has ben Published" name="judul">
										<input type="hidden" value="Produk anda <b>{{ $produk->nama_produk }}</b> telah di publish" name="pesan">
										
										<input type="hidden" name="id_produk" id="id_produk" value="{{ $produk->id }}">
									</div>
									</div>

									<div class="modal-footer">
									<div class="row">
									<div class="col-sm-12">
									<button type="submit" class="btn btn-success" style="width:100%;" id="publish" data-loading-text="Loading...">PUBLIKASIKAN</button>
									</div>

									<div class="col-sm-0"></div>
																<!--<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>-->
									</div>
									</div>
								
								</form>
            </div>
        </div>
    </div>

		
    
@endsection
@section('js')
<script>

</script>
@endsection