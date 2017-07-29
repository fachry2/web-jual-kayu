<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Usaha;
use App\User;
use App\KategoriProduk;
use App\GambarProduk;
use App\JenisProduk;
use App\JenisMaterial;
use App\Notifikasi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/admin/dashboard');
        //return view('admin.index2');
    }
    public function dashboard()
    {
        $user = User::get();
        $produk = Produk::get();
        $usaha = Usaha::get();
        //return dd($user->count());
        return view('admin.dashboard', compact(['user', 'produk', 'usaha']));
    }
    public function view_user()
    {
        return view('admin.view_user');
    }
    public function view_usaha()
    {
        return view('admin.view_usaha');
    }

    public function allProduks()
    {
        // $produk = DB::table('produks')
        // ->join('usaha', 'produks.id_usaha', '=', 'usaha.id')
        // ->select('produks.*', 'usaha.*')
        // ->get();
        $produk = DB::select('select pr.id, pr.id_usaha, pr.id_kategori, pr.foto, pr.nama_produk, pr.harga, pr.ukuran, pr.berat, pr.satuan_berat, pr.stok, pr.deskripsi, pr.status, pr.created_at, pr.updated_at, us.nama_usaha, us.alamat_usaha from produks pr inner join usaha us where pr.id_usaha = us.id order by pr.created_at desc');
        //return dd($produk);
        //return dd(Produk::all(), $produk);
        return view('admin.view_produk', compact('produk'));
    }

    public function editProduk($id){
        $produk = Produk::find($id);
        $usaha = Usaha::find($produk->id_usaha);
        $foto = DB::select('select * from foto_produk where id_produk='.$id);
        $material = DB::table('produk_material_select')
        ->join('jenis_material', 'produk_material_select.id_material','=','jenis_material.id')
        ->select('produk_material_select.*', 'jenis_material.material', 'jenis_material.status', 'jenis_material.created_at')
        ->where('produk_material_select.id_produk','=',$id)
        ->get();
        $kategori = KategoriProduk::find($produk->id_kategori);
        $user = User::find($usaha->id_user);
        //return dd($produk, $foto, $material, $usaha, $kategori, $user);
        return view('admin.edit_produk', compact(['produk', 'foto', 'material', 'usaha', 'kategori', 'user']));
    }

    public function updatingProduk(Request $request, Produk $produk){
        DB::table('produks')
        ->where('id', $request->id_produk)
        ->update(['status' => 1]);

        $pesan = new Notifikasi();
        $pesan->id_usaha = $request->id_usaha;
        $pesan->judul_notif = $request->judul;
        $pesan->pesan = $request->pesan;
        $pesan->save();
        
        return redirect('/admin/produk/edit/'.$request->id_produk)->with('message', 'Produk Telah Disetujui');

        //return $request->all();
    }

    public function updateMaterial(Request $request){
        DB::table('jenis_material')
        ->where('id', $request->id_material)
        ->update(['status' => 1]);

        $pesan = new Notifikasi();
        $pesan->id_usaha = $request->id_usaha;
        $pesan->judul_notif = $request->judul;
        $pesan->pesan = $request->pesan;
        $pesan->save();
        
        return back();
        //return redirect('/admin/produk/edit/'.$request->id_produk)->with('message', 'Material disetujui');
    }

    //NOTIFIKASI CONTROLLER
    // public function formNotifikasi(Request $request){
    //     $data = $request;
    //     //return $data->id_usaha;
    //     return view('admin.form_notifikasi', compact('data'));
    // }
    public function deleteMaterial(Request $request){
        $pesan = new Notifikasi();
        $pesan->id_usaha = $request->id_usaha;
        $pesan->judul_notif = $request->judul;
        $pesan->pesan = $request->pesan;
        $pesan->save();
        
        $material = JenisMaterial::find($request->id_material);
        $material->delete();
        //return $request->all();
        return back();

    }

}