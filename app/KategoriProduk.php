<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    protected $table = 'kategori_produk';

    public $timestamps = false;
    // use Notifiable;

    protected $fillable = [
        'kategori'
    ];

    // public function jenis(){
    //     return $this->belongsTo(Produk::class);
    // }
}
