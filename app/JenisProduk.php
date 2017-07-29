<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    protected $table = 'jenis_furniture';

    public $timestamps = false;
    // use Notifiable;

    protected $fillable = [
        'jenis',
    ];

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}
