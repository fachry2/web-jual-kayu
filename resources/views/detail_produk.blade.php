@extends('index')
@section('css_in')
<style>
    .chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 250px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>
@endsection
@section('data_menu')
<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-7">
        <div class="detail-gallery">
            
            <div class="newarrival">
            <b>
            <span class="fa fa-eye" style="font-size:25px;"></span>
            <br>120
            </b>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="/gambar_produk/{{ $produk->foto }}" alt="" widht="100"></a>
                        </div>
                        @foreach($foto as $foto)
                        @if($foto->foto != $produk->foto)
                        <div class="item">
                            <a href=""><img src="/gambar_produk/{{ $foto->foto }}" alt="" widht="100"></a>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
            </div>
            <div class="view-product">
                <!--<img src="/gambar_produk/{{ $produk->foto }}" alt="" width="30"/>
                <h3>ZOOM</h3>-->
            </div>
        </div><!-- /.detail-gallery -->


        </div>
        <div class="col-sm-5">
            <div class="product-information"><!--/product-information-->
            <div class="newarrival">
            <?php
                $find = 0;
            ?>
            @if(auth()->user())
                @foreach(auth()->user()->wishlist as $list)
                    @if($list->id_produk == $produk->id)
                        <?php
                            $find = $list->id;
                        ?>
                    @endif
                @endforeach
                @if($find != 0)
                    <form class="form-inline"  method="POST" action="/user/produk/delete_wishlist">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $find }}" name="id">
                        <button type="submit" style="background:none; border:none; font-size:200%;">
                            <i class="glyphicon glyphicon-heart" style="color:red;"></i>
                        </button>
                    </form>
                @else
                    <form class="form-inline"  method="POST" action="/user/produk/add_to_wishlist">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                        <button type="submit" style="background:none; border:none; font-size:200%;">
                            <i class="glyphicon glyphicon-heart-empty"></i>
                        </button>
                    </form>
                @endif
            @else
                <form class="form-inline"  method="GET" action="/login">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                    <button type="submit" style="background:none; border:none; font-size:200%;">
                        <i class="glyphicon glyphicon-heart-empty"></i>
                    </button>
                </form>
            @endif
            </div>            
                <!--<img src="images/product-details/new.jpg" class="newarrival" alt="" />-->
                <h2>{{$produk->nama_produk}}</h2>
                <p>Kategori : {{ $kategori->kategori }}</p>
                    <h2>Rp. {{ $produk->harga }}</h2>
                    <input type="hidden" value="{{ $produk->harga }}" id="harga">
                    <br>
                    <label>Quantity:</label><br>
                    <input type="number" class="form-control" value="1" style="widht:30%;" min="1" max="{{$produk->stok}}" id="jumlah"/>
                    <label>Total:</label><h2 id="totalBeli">0</h2>
                    <label>Cek Harga:</label><br>
                    <form method="POST" action="/cek_ongkir">
                
                    {{ csrf_field() }}
                    <label>Kota Asal</label><br>
                    <input type="text" value="{{$usaha->id_kota}}" id="asal" name="asal">
                    <!--<select name='asal' id='asal'>
                        <option>Pilih Kota Asal</option>
                    </select>-->
                    <br>
                    <label>Provinsi Tujuan</label><br>
                    <select name='provinsi' id='provinsi'>
                        <option>Pilih Provinsi Tujuan</option>
                    </select>
                    <label>Kabupaten Tujuan</label><br>
                    <select id="kabupaten" name="kabupaten">
                    </select><br><br>

                    <label>Kurir</label><br>
                    <select id="kurir" name="kurir">
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS INDONESIA</option>
                    </select><br><br>

                    <label>Berat (gram) : {{$produk->berat}}</label><br>
                    <input id="berat" type="text" name="berat" value="{{$produk->berat*1000}}" />
                    <br><br>
                    </form>
                    <input id="cek" type="submit" value="Cek"/>
                    <br>
                    <div>
                    <ul id="ongkir">
                    </ul>
                    </div>
                    <button type="button" class="btn btn-success add-to-cart" class="form-inline">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                    <a href="#"class="btn btn-success add-to-cart" id="btnChat">
                        <i class="glyphicon glyphicon-send"></i>
                        Kirim Pesan
                    </a>
                <p><b>Stok:</b> {{$produk->stok}}</p>
                <p><b>Brand:</b></p>
                <ul class="list-unstyled scroll-view">
                    <li class="media event">
                    <img src="/profil_usaha/{{$usaha->foto}}" alt="" class="pull-left border-aero profile_thumb" style="width:60px; height:60px; padding:0px; border-radius:30%;">
                    <div class="media-body">
                        <a class="title" href="#">{{$usaha->nama_usaha}}</a>
                        <p><small>by</small><strong> {{$user->nama}} </strong></p>
                        <p> <small>{{$usaha->alamat_usaha}}</small>
                        <hr>
                    </div>
                    </li>
                </ul>
                <!--<img src="images/product-details/rating.png" alt="" />
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>-->
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->
    
    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#deskripsi" data-toggle="tab">Deskripsi</a></li>
                <li><a href="#perawatan" data-toggle="tab">Cara Perawatan</a></li>
                <li><a href="#reviews" data-toggle="tab">Review</a></li>
            </ul>
        </div>
        <div class="tab-content">
        
            <div class="tab-pane fade active in" id="deskripsi">
                <div class="col-sm-12">
                    <ul>
                        <li><a href="#"><i class="fa fa-user"></i>{{ $user->nama }}</a></li>
                        <li><a href="#"><i class="fa fa-clock-o"></i>{{ $produk->created_at->toTimeString() }}</a></li>
                        <li><a href="#"><i class="fa fa-calendar-o"></i>{{ $produk->created_at->toDateString() }}</a></li>
                    </ul>
                    <p>
                        {{$produk->deskripsi}}
                    </p>
                    <b>Material :</b>
                    <ul>
                        @foreach($material as $mat)
                        <li>- {{ $mat->material }}</li><br>
                        @endforeach
                    </ul>

                    <b>Ukuran :</b>
					{{ $produk->p }} x {{ $produk->l }} x {{ $produk->t }}
                    
                </div>
            </div>
        
            <div class="tab-pane fade" id="perawatan">
                <div class="col-sm-12">
                    <p style="padding:15px;">
                        <b>Cara Merawat :</b>
                        <br>
                        {{$produk->cara_perawatan}}
                    </p>                    
                </div>
            </div>
            
            <div class="tab-pane fade" id="reviews">
                <div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p><b>Write Your Review</b></p>
                    
                    <form action="#">
                        <span>
                            <input type="text" placeholder="Your Name"/>
                            <input type="email" placeholder="Email Address"/>
                        </span>
                        <textarea name="" ></textarea>
                        <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                        <button type="button" class="btn btn-default pull-right">
                         Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/category-tab-->
</div>

    <!--MODAL--><!-- Modal -->
    <div id="chatModal" class="modal fade bs-example-modal-sm" role="dialog">
        <div class="modal-dialog modal-sm" role="document">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pesan Baru</h4>
                </div>
                <form method="post" action="#">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="/gambar_produk/{{ $produk->foto }}" alt="User Avatar" class="img-circle" height="50"/>
                            </span>
                            <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">{{$produk->nama_produk}}</strong>
                            </div>
                            <p>{{$produk->deskripsi}}</p>
                            <b>{{ $usaha->nama_usaha }}</b>
                            </div>
                        </div>
                        <p>
                        </p>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Subyek: </label><input type="text" id="subyek" value="{{$produk->nama_produk}}" style="margin-left:5px; border:none;">
                            <textarea style="border:none; padding:10px" rows="5" id="isiPesan" name="isiPesan" placeholder="Isi pesan disini..." autofocus></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-right" id="simpan" data-loading-text="Loading..."><i class="glyphicon glyphicon-send"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    
    var harga = $('#harga').val();
    var totalBeli = $('#totalBeli').html();
    $('#jumlah').change(function(){
        totalBeli = harga*$('#jumlah').val();
        $('#totalBeli').html(totalBeli);
    });
    
    $('#totalBeli').html(harga*$('#jumlah').val());

    //Button Chat
    $('#btnChat').click(function(){
        $('#chatModal').modal('show');
    });

    //Ambil data dari kabupaten
    $('#provinsi').change(function(){
        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var prov = $('#provinsi').val();
        //alert(prov);
        $('#kabupaten').html('<option>LOAD DATA..</option>');

        var hasil="";
        $.ajax({
            type : 'GET',
            url : '/get_kabupaten/'+prov,
            success: function (result) {
                //console.log(result['rajaongkir']['results']);
                for(var i=0; i<result['rajaongkir']['results'].length; i++){
                    hasil += "<option value="+result['rajaongkir']['results'][i]['city_id']+">"+result['rajaongkir']['results'][i]['city_name']+"</option>"
                }
                //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                $("#kabupaten").html(hasil);
            }
        });
    });

    $("#cek").click(function(){
        //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax 
        var asal = $('#asal').val();
        var kab = $('#kabupaten').val();
        var kurir = $('#kurir').val();
        var berat = $('#berat').val();
        
        //alert(asal+" "+kab+" "+kurir+" "+berat);
        $("#ongkir").text('Memuat Harga....');
        $.ajax({
            type : 'POST',
            url : '/cek_ongkir',
            data :  {
                '_token': $('input[name=_token]').val(),
                'kab_id' : kab, 
                'kurir' : kurir, 
                'asal' : asal, 
                'berat' : berat
            },
            success: function (result) {
                var harga="";
                //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
                if(result['rajaongkir']['status']['code'] == 400){
                    $("#ongkir").text(result['rajaongkir']['status']['description']);
                }else if(result['rajaongkir']['status']['code'] == 200)
                {
                    if(result['rajaongkir']['results'][0]['code'] == 'jne')
                    {
                        //$("#ongkir").text('JNE');
                        console.log(result['rajaongkir']['results'][0]['costs']);
                        for(var i=0; i<result['rajaongkir']['results'][0]['costs'].length; i++){
                            var jenisPaket = result['rajaongkir']['results'][0]['costs'][i]['description'];
                            var hargaPaket = result['rajaongkir']['results'][0]['costs'][i]['cost'][0]['value'];
                            var estimasi = result['rajaongkir']['results'][0]['costs'][i]['cost'][0]['etd'];
                            harga += "<li><b>"+jenisPaket+"</b> Rp. "+hargaPaket+" ("+estimasi+") hari</li>";
                        }
                        $("#ongkir").html('<li><b>JNE :</b></li>'+harga);
                    
                    }else if(result['rajaongkir']['results'][0]['code'] == 'tiki')
                    {
                        console.log(result['rajaongkir']['results'][0]['costs']);
                        for(var i=0; i<result['rajaongkir']['results'][0]['costs'].length; i++){
                            var jenisPaket = result['rajaongkir']['results'][0]['costs'][i]['description'];
                            var hargaPaket = result['rajaongkir']['results'][0]['costs'][i]['cost'][0]['value'];
                            var estimasi = result['rajaongkir']['results'][0]['costs'][i]['cost'][0]['etd'];
                            harga += "<li><b>"+jenisPaket+"</b> Rp. "+hargaPaket+" ("+estimasi+") hari</li>";
                        }
                        $("#ongkir").html('<li><b>TIKI :</b></li>'+harga);

                    }else if(result['rajaongkir']['results'][0]['code'] == 'pos')
                    {
                        console.log(result['rajaongkir']['results'][0]['costs']);
                        for(var i=0; i<result['rajaongkir']['results'][0]['costs'].length; i++){
                            var jenisPaket = result['rajaongkir']['results'][0]['costs'][i]['description'];
                            var hargaPaket = result['rajaongkir']['results'][0]['costs'][i]['cost'][0]['value'];
                            var estimasi = result['rajaongkir']['results'][0]['costs'][i]['cost'][0]['etd'];
                            harga += "<li><b>"+jenisPaket+"</b> Rp. "+hargaPaket+" ("+estimasi+") hari</li>";
                        }
                        $("#ongkir").html('<li><b>POS :</b></li>'+harga);
                    }
                }
            },
            error: function(err){
                console.log("error: "+err);
            }
        });
	});


    //GET API KABUPATE/KOTA
        var hasilKota="";
        $('#asal').html('<option>LOAD DATA..</option>');

        $.ajax({
        type : 'GET',
        url : '/get_all_kabupaten',
        success: function (result) {            
            for(var i=0; i<result['rajaongkir']['results'].length; i++){
                hasilKota += "<option value="+result['rajaongkir']['results'][i]['city_id']+">"+result['rajaongkir']['results'][i]['city_name']+"</option>";
            }
            $('#asal').html(hasilKota);
            //console.log(hasilKota);
        }
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

});
</script>
@endsection