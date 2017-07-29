<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

//use Eloquent;
class Usaha extends Model
{
    //Model
    use Notifiable;
    protected $table = 'usaha';
    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'nama_usaha', 'alamat_usaha', 'id_provinsi', 'nama_provinsi', 'id_kota', 'nama_kota', 'foto'
    ];

    // public function user(){
    //     return $this->hasOne(User::class);
    // }

    public function produk(){
        return $this->hasMany(Produk::class, 'id_usaha');
    }

    public function notifikasi(){
        return $this->hasMany(Notifikasi::class, 'id_usaha');
    }

}
