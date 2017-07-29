<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    
    protected $table = 'foto_produk';

    public $timestamps = false;
    // use Notifiable;

    protected $fillable = [
        'id_produk',
        'foto',
    ];

    public function produk(){
        return $this->belongsTo(Produk::class);
    }

}
