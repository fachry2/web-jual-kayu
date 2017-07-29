<?php

namespace App\Http\Controllers;

use App\User;
use App\Produk;
use App\GambarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
//use Validator;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class PengrajinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index(){
        if(auth()->user()->milikiUsaha())
            return view('pengrajin.index');
        else
            return redirect('/user/buka_toko');
    }

    public function profile(){
        return view('penjual.profile');
    }

    public function prosuks(){
        return "PRODUK";
    }


    //MENU
    public function produk(){
        $dataProduks = DB::select('SELECT * FROM tbl_produk WHERE id_user='.auth()->user()->id);
        //return dd($dataFoto);
        return view('penjual.menuProduk', compact('dataProduks'));
    }

    public function lihat_produk($id){
        $id_user = auth()->user()->id;
        $dataProduks = DB::select('SELECT * FROM tbl_produk WHERE id='.$id);
        $dataFoto = DB::select('SELECT * FROM (SELECT pr.id, ftpr.foto FROM tbl_produk pr INNER JOIN tbl_foto_produk ftpr ON pr.id = ftpr.id_produk WHERE pr.id_user='.$id_user.') tbl_data WHERE tbl_data.id ='.$id);
        return dd($dataProduks,$dataFoto);
    }

    public function tambahProduk(){
        return view('penjual.menuTambahProduk');
    }

    public function pemesanan(){
        return view('penjual.menuPemesanan');
    }

    public function konfirmPengiriman(){
        return view('penjual.menuKonfirmasiPengiriman');
    }

    public function pesan(){
        return view('penjual.menuPesan');
    }

    public function tender(){
        return view('penjual.menuTender');
    }


    //FUNCTION SIMPAN KE DATABESE
    public function postProduk(Request $request, Produk $produk){

        //  $this->validate($request, [
        //     'namaProduk' => 'requred',
        //     'katogori' => 'required',
        //     'harga' => 'required',
        //     'jenisKayu' => 'requred',
        //     'ukuran' => 'required',
        //     'berat' => 'required',
        //     'status' => 'required',
        //      'gambar' => 'image|mimes:jpeg,bmp,png|size:2000'
        //  ]);
        //$jenis_kayu = Input::get('')
        $jenis_kayu = $request->input('jenisKayu');
        $idProdukRand = rand(1111111,9999999);
        $produk = $produk->create([
            'id' => $idProdukRand,
            'id_usaha' => auth()->user()->usaha->id,
            'id_kategori' => $request->kategori,
            'nama_produk' => $request->namaProduk,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'berat' => $request->berat,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);

        $files = Input::file('gambar');
        $file_count = count($files);
        $uploadCount = 0;
 
        foreach ($files as $file){
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file'=>$file), $rules);
            if($validator->passes()){
                $destinationPath = 'gambar_produk';
                $extension = $file->getClientOriginalExtension();
                $filename = rand(11111,99999).".".$extension;
                $upload_success = $file->move($destinationPath, $filename);
                $uploadCount ++;

                //save into database
                $data = new GambarProduk();
                $data->id_produk = $idProdukRand;
                $data->foto = $filename;
                $data->save();
            }
        }

        // if($uploadCount == $file_count){
        //     Session::flash('success', 'Upload Sukses');
        // }else{}


        return dd($request->all());
    }
}
