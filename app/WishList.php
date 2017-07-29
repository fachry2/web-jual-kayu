<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlist';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_produk'
    ];

    public function produk(){
        return $this->hasOne(Produk::class, 'id_produk');
    }

    public function user(){
        return $this->hasOne(User::class, 'id_user');
    }
}
