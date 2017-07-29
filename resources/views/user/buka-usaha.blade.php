@extends('layouts.app-user')

@section('content')
    <div class="container">
        <div class="page-header" align="center">
            <h2>REGISTRASI USAHA ANDA</h2>
            <p class="lead">Dengan membuka usaha anda dapat melakukan penjualan produk anda.</p>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel-body">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/post_usaha') }}" enctype="multipart/form-data">
                        <input type="hidden" value="{{ csrf_token() }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="nama" type="text" class="form-control" value="{{ old('nama') }}" required autofocus placeholder="Nama Usaha">

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option value="0">[ Pilih Provinsi ]</option>
                                    </select>
                                </span>
                                <input type="text" id="namaProv" name="namaProv">
                                @if ($errors->has('provinsi'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('provinsi') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kota') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                    <select class="form-control" name="kota" id="kota">
                                        <option value="0">[ Kota ]</option>
                                    </select>
                                </span>
                                <input type="text" id="namaKota" name="namaKota">
                                @if ($errors->has('kota'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('kota') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required autofocus placeholder="Alamat Usaha Anda">

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <input type="file" accept="image/jpeg,image/png" name="gambar">
                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('gambar') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary-daftar" style="width: 100%">
                                    Buka Usaha
                                </button>
                            </div>
                        </div>
                        <hr width="100%">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loginFacebook(){
            window.location.href = "{{URL::to('login/facebook')}}";
        }
        function loginGoogle(){
            window.location.href = "{{URL::to('login/google')}}";
        }
    </script>

<script>
    $(document).ready(function() {
        //GET API KABUPATE/KOTA
        //Ambil data dari kabupaten
        $('#provinsi').change(function(){
            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
            var prov = $('#provinsi').val();
            //alert(prov);
            $('#namaProv').val($('#provinsi').find('option:selected').text());
            $('#kota').html('<option>LOAD DATA..</option>');

            var hasil="";

            $.ajax({
                type : 'GET',
                url : '/get_kabupaten/'+prov,
                success: function (result) {
                    console.log(result['rajaongkir']['results'][0]['province']);
                    for(var i=0; i<result['rajaongkir']['results'].length; i++){
                        hasil += "<option value="+result['rajaongkir']['results'][i]['city_id']+">"+result['rajaongkir']['results'][i]['city_name']+"</option>"
                    }
                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    //$('#namaProv').val(result['rajaongkir']['results'][0]['province']);
                    $("#kota").html(hasil);
                    $('#namaKota').val($('#kota').find('option:selected').text());
                },
                error: function(){
                    $("#kota").html('<option>ERROR LOAD DATA</option>');
                }
            });
        });

        //GET API PROVINSI
            var hasilProvinsi="";
            $('#provinsi').html('<option>LOAD DATA..</option>');
            $.ajax({
            type : 'GET',
            url : '/get_provinsi',
            success: function (result) {            
                for(var i=0; i<result['rajaongkir']['results'].length; i++){
                    hasilProvinsi += "<option value="+result['rajaongkir']['results'][i]['province_id']+">"+result['rajaongkir']['results'][i]['province']+"</option>";
                }
                $('#provinsi').html(hasilProvinsi);
                //console.log(hasilProvinsi);
            }
        });

        $('#kota').change(function(){
            $('#namaKota').val($('#kota').find('option:selected').text());
        });
    });
</script>
@endsection