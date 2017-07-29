<?php

namespace App\Http\Controllers;

use App\User;
use App\Produk;
use App\JenisProduk;
use App\Usaha;
use App\GambarProduk;
use App\KategoriProduk;

use App\JenisMaterial;
use App\ProdukMaterialSelect;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
//use Validator;
use Illuminate\Support\Facades\Validator;
use Session;
// use Illuminate\Support\Str;

class PengrajinController extends Controller
{    
    public function index(){
        if(auth()->user()->milikiUsaha())
            return view('pengrajin.index');
        else
            return redirect('/user/buka_toko');
    }

    public function getJenis($id){
        $jenis = DB::select('SELECT * FROM kategori_produk WHERE id_jenis='.$id);

        return $jenis;
    }

    public function usahaProduk(){
        if(auth()->user()->milikiUsaha()){
            $produks = DB::table('produks')
            ->join('kategori_produk', 'produks.id_kategori', '=', 'kategori_produk.id')
            ->where('produks.id_usaha','=',auth()->user()->usaha->id)
            //->join('foto_produk', 'produks.id', '=', 'foto_produk.id_produk')
            ->select('produks.*', 'kategori_produk.kategori')
            //->groupBy('id_produk')
            ->get();

            //$jenisProduk = JenisProduk::all();
            $kategori = KategoriProduk::all();

            
            //$fotos = DB::select('SELECT * FROM foto_produk GROUP BY id_produk');
            // $data = array();
            // foreach($produks as $prd){
            //     if($prd->id == $foto->id_produk){
            //         $data[] = array($foto->id_produk, $foto->foto);
            //         //array_push($data, '2');
            //     }
            // }
            //$produks = Usaha::find(auth()->user()->usaha->id)->produk;
            return view('pengrajin.menuProduk', compact(['produks', 'kategori']));
            //return dd($produks);
        }
            //return view('pengrajin.menuProduk');
        else
            return "ANDA HARUS BUKA USAHA";
    }


    public function form_edit_produk($id){
        if(auth()->user()->milikiUsaha()){            
            $produk = Produk::find($id);
            $foto = DB::select('select * from foto_produk where id_produk='.$id);
            $material = DB::table('produk_material_select')
            ->join('jenis_material', 'produk_material_select.id_material','=','jenis_material.id')
            ->select('produk_material_select.*', 'jenis_material.material', 'jenis_material.status', 'jenis_material.created_at')
            ->where('produk_material_select.id_produk','=',$id)
            ->get();
            $kategori = KategoriProduk::find($produk->id_kategori);
            //return dd($produk, $foto, $material, $kategori);
            return view('pengrajin.formEditProduk', compact(['produk', 'foto', 'material', 'kategori']));
        }else
            return redirect('/user/buka_toko');
    }

    public function cari_produk($id){
        if(auth()->user()->milikiUsaha()){
            $produks = DB::select('SELECT * FROM produks WHERE id_jenis='.$id);
            $jenisProduk = JenisProduk::all();
            $kategori = KategoriProduk::all();
            return view('pengrajin.menuProduk', compact(['produks', 'jenisProduk', 'kategori']));
        }else{
            return redirect('/user/buka_toko');
        }
    }
    
    public function usahaTambahProduk(){
        if(auth()->user()->milikiUsaha()){
            $kategori = DB::select('SELECT * FROM kategori_produk');
            $materialTrue = JenisMaterial::get()->where('status','=',1);
            $materialFalse = JenisMaterial::get()->where('status','=',0);
            //return dd($kategori, $materialTrue->count(), $materialFalse->count());
            return view('pengrajin.menuTambahProduk', compact(['kategori', 'materialTrue', 'materialFalse']));
        }else
            return redirect('/user/buka_toko');
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
        //     'gambar' => 'image|mimes:jpeg,bmp,png|size:2000'
        //  ]);
        //$jenis_kayu = Input::get('')
        
        //variabel
        $idProdukRand = rand(1111111,9999999);
        $ukuran = $request->ukuran." ".$request->satuanUkuran;
        $panjang = $request->p." ".$request->p_satuanUkuran;
        $lebar = $request->l." ".$request->l_satuanUkuran;
        $tinggi = $request->t." ".$request->t_satuanUkuran;

        $produk = $produk->create([
            'id' => $idProdukRand,
            'id_usaha' => auth()->user()->usaha->id,
            'id_kategori' => $request->kategori,
            'nama_produk' => $request->namaProduk,
            'harga' => $request->harga,
            'ukuran' => $ukuran,
            'berat' => $request->berat,
            'satuan_berat' => $request->satuanBerat,
            'p' => $panjang,
            'l' => $lebar,
            't'=> $tinggi,
            'stok' => $request->stok,
            'status' => 0,
            'deskripsi' => $request->deskripsi,
            'cara_perawatan' => $request->perawatan
        ]);

        $files = Input::file('gambar');
        $file_count = count($files);
        $uploadCount = 0;
        $filename="";

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

        $update = Produk::findOrFail($idProdukRand);
        $update->foto = $filename;
        $update->save();

        $jenis_material = $request->input('jenisKayu');
        foreach($jenis_material as $jenis){
            $data = new ProdukMaterialSelect();
            $data->id_produk = $idProdukRand;
            $data->id_material = $jenis;
            $data->save();
        }

        return redirect('/user/usaha/produk');
        //return dd($request->all());
    }

    public function tambah_material(Request $request, JenisMaterial $material){
        if(auth()->user()->milikiUsaha()){
            $material = $material->create([
                'material' => $request->materialBaru
            ]);
            return redirect('/user/usaha/tambah_produk');
        }else{
            return redirect('/user/buka_toko');           
        }
    }

    //CONTROLLER PRODUK
    public function updateGambarProduk(Request $request){
        return $request->all();
    }

}