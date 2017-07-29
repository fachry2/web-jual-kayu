<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\JenisProduk;
use App\KategoriProduk;
use App\Produk;
use App\GambarProduk;
use App\Usaha;
use App\WishList;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //PRODUK
    public function view_produk(){
        $kategori = KategoriProduk::all();
        //return view('pengrajin.menuProduk', compact(['produks', 'jenisProduk', 'kategori']));
        return view('view_produk', compact('kategori'));
    }
    public function detail_produk($id){
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
        //return dd($produk, $usaha, $foto, $jenis_kayu, $user, $kategori);
        return view('detail_produk', compact(['produk', 'usaha', 'foto', 'material', 'user', 'kategori']));
    }
    public function cari_produk(){

        $jenisProduk = JenisProduk::all();
        $kategori = KategoriProduk::all();
        //return view('pengrajin.menuProduk', compact(['produks', 'jenisProduk', 'kategori']));
        return view('cari_produk', compact(['jenisProduk', 'kategori']));
        //return view('cari_produk');
    }
    public function kategori_produk($id){
        $produk = DB::select('select * from produks where id_kategori='.$id.'&& status=1');
        //$produk = Produk::all()->where('id_kategori','=',$id, 'AND','status','=',1);
        //return $produk;
        return view('welcome', compact('produk'));
    }
    //All Produk
    public function landingPage(){
        $produk = Produk::get()->where('status', '=', 1);

        // $wihslist2 = Auth::with(['user'])->get();
        // $wihslist = auth()->user()->wishlist;
        // return $wihslist;
        return view('welcome', compact('produk'));
    }
}
