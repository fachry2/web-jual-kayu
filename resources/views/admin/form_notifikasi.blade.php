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
            </div>

            <div class="title_right">
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
            <h2>Kirim Pesan <small>to </small><span class="badge badge-danger">{{ App\Usaha::find($data->id_usaha)->nama_usaha }}</span>
            <span class="badge badge-danger">{{ App\Produk::find($data->id_produk)->nama_produk }}</span></h2>
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

            <!-- start form for validation -->
            <form id="demo-form" data-parsley-validate action="/admin/kirim_pesan" method="POST">
                {{ csrf_field() }}
                <input type="hidden" value="{{$data->id_usaha}}" name="id_usaha">
                <input type="hidden" value="{{$data->id_material}}" name="id_material">
                <label for="fullname">Judul Pesan</label>
                <input type="text" id="judul" class="form-control" name="judul" value="Permintaan penambahan material {{ $data->material }} GAGAL" readOnly/>
                <label for="message">Message (20 chars min, 100 max) :</label>
                <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                data-parsley-validation-threshold="10"></textarea>

                <br/>
                <button type="submit" class="btn btn-primary">KIRIM</button>
            </form>
            <!-- end form for validations -->

            </div>
        </div>
       </div>
    </div>

</div>
@endsection
@section('js')
@endsection