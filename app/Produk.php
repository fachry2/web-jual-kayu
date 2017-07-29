<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Produk extends Model
{

    protected $table = 'produks';

    public $timestamps = true;
    use Notifiable;

    protected $fillable = [
        'id',
        'id_usaha',
        'id_kategori',
        'nama_produk',
        'harga',
        'ukuran',
        'berat',
        'satuan_berat',
        'p',
        'l',
        't',
        'stok',
        'foto',
        'status',
        'deskripsi',
        'cara_perawatan'
    ];

    // public function usaha(){
    //     return $this->belongsTo(Usaha::class);
    // }


    public function gambar(){
        return $this->hasMany(GambarProduk::class, 'id_produk');
    }

    public function material(){
        return $this->hasMany(ProdukMaterialSelect::class, 'id_produk');
    }

    public function wishlist(){
        return $this->belongToMany(Wishlist::class, 'id_produk');
    }
}
