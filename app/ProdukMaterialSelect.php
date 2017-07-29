<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukMaterialSelect extends Model
{
    protected $table = 'produk_material_select';

    public $timestamps = false;
    // use Notifiable;

    protected $fillable = [
        'id_produk',
        'id_material'
    ];
}
