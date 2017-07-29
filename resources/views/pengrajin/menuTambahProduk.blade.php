@extends('pengrajin.index')

@section('menu')

    <div class="well">

        <div class="text-left">
            <h3>Tambah Produk</h3>
        </div>
        
        <hr>
        <form action="{{url('user/usaha/postProduk')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Apa yang anda Jual</h3>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="namaProduk" name="namaProduk" type="text" value="{{ old('namaProduk') }}" placeholder="Product Name">
                                    @if ($errors->has('namaProduk'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('namaProduk') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label for="disabledSelect" class="col-sm-2 control-label">Kategori</label>
                                <div class="col-sm-10 form-inline">
                                    <select class="form-control" name="kategori" id="kategori" style="width:34%">
                                        <option value="0">[ Pilih Kategori Furniture ]</option>
                                        @foreach($kategori as $data)
                                            <option value="{{ $data->id }}">{{ $data->kategori }}</option>
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
                    <h6 style="margin:0; padding: 0;">Jelaskan tentang produk anda</h6>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Harga</label>
                                <div class="col-sm-10 form-inline">
                                <input class="form-control" type="number" name="harga" id="harga" min="0" value="0">
                                    @if ($errors->has('harga'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('harga') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label for="disabledSelect" class="col-sm-2 control-label">Material / Jenis Kayu</label>
                                <div class="col-sm-10">
                                    <?php $ada = 0; ?>
                                    @foreach($materialTrue as $m)                                    
                                    <label class="checkbox checkbox-inline"><input type="checkbox" name="jenisKayu[]" value="{{$m->id}}"> {{ $m->material }}</label>
                                    @endforeach
                                    <input type="button" class="btn btn-danger" name="material_new" id="material_new" value="New">
                                    @if ($errors->has('jenisKayu'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('jenisKayu') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($materialFalse->count() != 0)
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-2">
                                <div class="col-sm-10">
                                    <i style="font-size:12px;">Material ini belum disetui oleh admin, jika anda memerlukannya admin akan memeriksanya sebelum produk anda di publish</i><br>
                                    @foreach($materialFalse as $mF)
                                    <label class="checkbox checkbox-inline" style="color:red;"><input type="checkbox" name="jenisKayu[]" value="{{$mF->id}}"> {{ $mF->material }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row" style="margin-top:20px">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Dimensi</label>
                                <div class="col-sm-10 form-inline">
                                    <!--<input class="form-control" id="p" type="text" name="p" style="width:7%"> X 
                                    <input class="form-control" id="l" type="text" name="l" style="width:7%"> X 
                                    <input class="form-control" id="t" type="text" name="t" style="width:7%">-->
                                    
                                    <label class="col-sm-2 control-label">Panjang</label>
                                    <input class="form-control" id="p" type="number" name="p" style="width:10%" value="0" min="0">
                                    <select class="form-control" id="p_satuan" name="p_satuanUkuran" style="padding:2px 3px;">
                                        <option value="m">m</option>
                                        <option value="cm">cm</option>
                                    </select>
                                    <br>

                                    <label class="col-sm-2 control-label">Lebar</label>
                                    <input class="form-control" id="l" type="number" name="l" style="width:10%" value="0" min="0">
                                    <select class="form-control" id="l_satuan" name="l_satuanUkuran" style="padding:2px 3px;">
                                        <option value="m">m</option>
                                        <option value="cm">cm</option>
                                    </select>
                                    <br>

                                    <label class="col-sm-2 control-label">Tinggi</label>
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
                                    <input class="form-control" id="berat" type="number" min="0" name="berat" style="width:20%" value="0">
                                    <select class="form-control" id="satuanBerat" name="satuanBerat" style="padding:2px 3px;">
                                        <option value="Kg">Kg</option>
                                        <option value="g">g</option>
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
                                    <input type="number" name="stok" class="form-control" min="0"style="width:20%">
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
                                    <textarea class="form-control" rows="5" id="comment" name="deskripsi" id="deskripsi"></textarea>
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
                                    <textarea class="form-control" rows="5" id="comment" name="perawatan" id="perawatan"></textarea>
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
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Gambar Produk</h3>
                    <h6 style="margin:0; padding: 0;">Masukkan ambar produk minimal 1 foto</h6>
                </div>
                <div class="panel-body">
                    <input type="file" multiple accept="image/jpeg,image/png" name="gambar[]">
                    @if ($errors->has('gambar'))
                        <span class="help-block">
                        <strong>{{ $errors->first('gambar') }}</strong>
                    </span>
                    @endif
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
// $(document).ready(function(){
//     $('#harga').maskMoney({
//         thousands:'.',
//         decimal:',',
//         precision:0
//     });
// });
</script>
<!--<script>
    // $('#myModal').on('shown.bs.modal', function () {
    //     $('#myInput').focus()
    // })

    $(document).ready(function() {
        $('#kategori').prop('disabled', true);
        $('#kategori').html("<option>--PILIH JENIS--</option>");
        $('#jenis').change(function() {
            var id_jenis = $(this).val();
            console.log(id_jenis)
            if(id_jenis!=0){
                $('#kategori').prop('disabled', true);
                $('#kategori').html("<option>LOADING DATA...</option>");
                var hasil="";
                $.ajax({
                    type: 'GET',
                    url:'/user/usaha/tambah_produk/get_jenis/'+id_jenis,
                    //data: dataJenis,
                    success: function(result){
                        console.log(result);
                        $('#kategori').prop('disabled', false);
                        for(var i=0; i<result.length; i++){
                            hasil += "<option value="+result[i].id+">"+result[i].kategori+"</option>"
                        }
                        $('#kategori').html(hasil+="<option style='background-color: red; color:white;' value=new>--BUAT BARU--</option>");
                    }
                });
            }else{
                $('#kategori').prop('disabled', true);
                $('#kategori').html("<option>--PILIH JENIS--</option>");
            }
        });

        //SHOW MODAL
        //AMBIL DATA JENIS UNTUK DITAMPILKAN KE MODAL TAMBAH KATEGORI
        $('#kategori').change(function() {
            if($(this).val() == 'new'){
                $('#myModal').modal('show');
                var idJS = $('#jenis').val();
                $('#jenisModal').html($('#jenis option[value='+idJS+']').text());
                $('#id_jenis_baru').val(idJS);
            }
        });

        $('button#simpan').click(function(e){
            e.preventDefault();
            //console.log('ADA');
            $('button#simpan').text('Loading..');
            $('button#simpan').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: '/user/usaha/tambah_produk/tambah_kategori',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id_jenis': $('#id_jenis_baru').val(),
                    'nama_kategori': $('#kategoriBaru').val()
                    },
                dataType: 'JSON',
                success: function(data){
                    console.log(data);
                    $('#kategoriBaru').val("");
                    $('#myModal').modal('hide');
                    $('button#simpan').prop('disabled', false);
                    $('button#simpan').text('Simpan');
                    
                    var hasil="";
                    $.ajax({
                        type: 'GET',
                        url:'/user/usaha/tambah_produk/get_jenis/'+$('#id_jenis_baru').val(),
                        //data: dataJenis,
                        success: function(result){
                            console.log(result);
                            //$('#kategori').prop('disabled', false);
                            for(var i=0; i<result.length; i++){
                                hasil += "<option value="+result[i].id+">"+result[i].kategori+"</option>"
                            }
                            $('#kategori').html(hasil+="<option style='background-color: red; color:white;' value=new>--BUAT BARU--</option>");
                        }
                    });
                },
                error: function(err){
                    console.log("error: "+err);
                },
            });
            //alert('ada');
        });
    });


</script>-->
@endsection