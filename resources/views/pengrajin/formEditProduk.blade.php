@extends('pengrajin.index')

@section('menu')

    <div class="well">

        <div class="text-left">
            <h3>Edit Produk</h3>
        </div>
        
        <hr>
        <form action="{{url('user/usaha/postProduk')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Gambar Produk</h3>
                </div>
                <div class="panel-body">
                    @foreach($foto as $ft)
                    @if($ft->foto == $produk->foto)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper" style="background:#fff;">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                        {{ $ft->id }}
                                        <img src="/gambar_produk/{{ $ft->foto }}" alt="" width="150">
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                    <b>Gambar Depan</b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-sm-3">
                        <div class="product-image-wrapper" style="background:#fff;">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                        <img src="/gambar_produk/{{ $ft->foto }}" alt="" width="150">
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <form method="POST" action="/user/usaha/produk/foto/update">
                                            {{ csrf_field() }}
                                            <input type="text" value="{{ $ft->id_produk }}" name="id_produk">
                                            <input type="text" value="{{ $ft->foto }}" name="id_foto">
                                            <button type="submit" class="btn add-to-cart" style="margin-bottom:0px; font-size:11px; color:#fff; width:100%; background:#5cb85c;">Jadikan Gambar Depan</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Produk</h3>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="namaProduk" name="namaProduk" type="text" value="{{ $produk->nama_produk }}" placeholder="Product Name">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label for="disabledSelect" class="col-sm-2 control-label">Kategori</label>
                                <div class="col-sm-10 form-inline">
                                    <select class="form-control" name="kategori" id="kategori" style="width:34%">
                                    @foreach(App\KategoriProduk::all() as $ktg)
                                        @if($ktg->id == $produk->id_kategori)
                                        <option value="{{ $ktg->id }}" class="glyphicon glyphicon-ok" selected> {{ $ktg->kategori }}</option>
                                        @else
                                        <option value="{{ $ktg->id }}">{{ $ktg->kategori }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                    <!--<select class="form-control" name="kategori" id="kategori" style="width:30%" disabled>
                                    </select>-->
                                    @if ($errors->has('kategori'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('kategori') }}</strong>
                                    </span>
                                    @endif
                                    
                                    <div id="newKategori">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Produk</h3>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Harga</label>
                                <div class="col-sm-10 form-inline">
                                <input class="form-control" type="number" name="harga" id="harga" min="0" value="{{ $produk->harga }}">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label for="disabledSelect" class="col-sm-2 control-label">Material / Jenis Kayu</label>
                                <div class="col-sm-10">
                                <?php $mat = 0; ?>
                                @foreach($material as $mat_sel)
                                    @if($mat_sel->status !=0 )
                                    <label class="checkbox checkbox-inline"><input type="checkbox" name="jenisKayu[]" value="{{ $mat_sel->id_material }}" checked>{{$mat_sel->material}}</label>
                                    @elseif($mat_sel->status ==0 )
                                    <?php $mat = 1; ?>
                                    @endif
                                @endforeach
                                <input type="button" class="btn btn-danger" name="material_new" id="material_new" value="New">
                                </div>
                            </div>
                        </div>
                        @if($mat != 0)
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-2">
                                <div class="col-sm-10">
                                    <i style="font-size:12px;">Material ini belum disetui oleh admin, jika anda memerlukannya admin akan memeriksanya sebelum produk anda di publish</i><br>
                                    
                                    @foreach($material as $mat_sel)
                                        @if($mat_sel->status ==0 )
                                        <label class="checkbox checkbox-inline" style="color:red;"><input type="checkbox" name="jenisKayu[]" value="{{ $mat_sel->id_material }}" checked>{{ $mat_sel->material }}</label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row" style="margin-top:20px">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Dimensi</label>
                                <div class="col-sm-10 form-inline">                                    
                                    <label class="col-sm-2 control-label">Panjang</label>
                                    <input class="form-control" type="text" style="width:10%" value="{{$produk->p}}" readOnly>
                                    <input class="form-control" id="p" type="number" name="p" style="width:10%" value="{{$produk->p}}" min="0">
                                    <select class="form-control" id="p_satuan" name="p_satuanUkuran" style="padding:2px 3px;">
                                        <option value="m">m</option>
                                        <option value="cm">cm</option>
                                    </select>
                                    <br>

                                    <label class="col-sm-2 control-label">Lebar</label>
                                    <input class="form-control" type="text" style="width:10%" value="{{$produk->l}}" readOnly>
                                    <input class="form-control" id="l" type="number" name="l" style="width:10%" value="0" min="0">
                                    <select class="form-control" id="l_satuan" name="l_satuanUkuran" style="padding:2px 3px;">
                                        <option value="m">m</option>
                                        <option value="cm">cm</option>
                                    </select>
                                    <br>

                                    <label class="col-sm-2 control-label">Tinggi</label>
                                    <input class="form-control" type="text" style="width:10%" value="{{$produk->t}}" readOnly>
                                    <input class="form-control" id="t" type="number" name="t" style="width:10%" value="0" min="0">
                                    <select class="form-control" id="t_satuan" name="t_satuanUkuran" style="padding:2px 3px;">
                                        <option value="m">m</option>
                                        <option value="cm">cm</option>
                                    </select>
                                    @if ($errors->has('ukuran'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ukuran') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Berat</label>
                                <div class="col-sm-10 form-inline">
                                    <input class="form-control" id="berat" type="number" min="0" name="berat" style="width:20%" value="{{ $produk->berat }}">
                                    <select class="form-control" id="satuanBerat" name="satuanBerat" style="padding:2px 3px;">
                                        @if($produk->satuan_berat == 'Kg')
                                            <option value="Kg" class="glyphicon glyphicon-ok" selected> Kg</option>
                                            <option value="g">g</option>
                                        @elseif($produk->satuan_berat == 'g')
                                            <option value="Kg">Kg</option>
                                            <option value="g" class="glyphicon glyphicon-ok" selected> g</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('berat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('berat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Stok</label>
                                <div class="col-sm-10 form-inline">
                                    <input type="number" name="stok" value="{{$produk->stok}}" class="form-control" min="0"style="width:20%">
                                    @if ($errors->has('stok'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('stok') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" id="comment" name="deskripsi" id="deskripsi">{{ $produk->deskripsi }}</textarea>
                                </div>
                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('deskripsi') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Cara Perawatan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" id="comment" name="perawatan" id="perawatan">{{ $produk->cara_perawatan }}</textarea>
                                </div>
                                @if ($errors->has('perawatan'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('perawatan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success" style="width:100%">
                        Pasang Iklan
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!--MODAL--><!-- Modal -->
    <div id="myModal" class="modal fade bs-example-modal-sm" role="dialog">
        <div class="modal-dialog modal-sm" role="document" style="width:25%;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">TAMBAH MATERIAL KAYU</h4>
                </div>
                <form method="post" action="{{url('user/usaha/tambah_produk/tambah_material')}}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>
                            Material baru yang anda tambahkan akan diperiksa admin.
                        </p>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Material: </label>
                            <input type="text" class="form-control" id="materialBaru" name="materialBaru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-right" id="simpan" data-loading-text="Loading...">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>

$(document).ready(function() {    
    $('#material_new').click(function(){
        $('#myModal').modal('show');
    });

});
</script>
@endsection