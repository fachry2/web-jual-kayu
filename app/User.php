<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    //Authenticatable
    //protected $table = 'users';
    use Notifiable;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'email', 'password', 'activated'
    ];

    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function usaha(){
        return $this->hasOne(Usaha::class,'id_user');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'id_user');
    }

    public function milikiUsaha(){
        if($this->usaha != null){
            return true;
        }
        return false;
    }


    // public function role(){
    //     return $this->belongsTo(Role::class, 'roles_id');
    // }

    // public function detail_user(){
    //     return $this->belongsTo(DetailUser::class);
    // }

    // public function produk(){
    //     return $this->hasMany(Produk::class);
    // }


    // public function rules($namaRole){
    //     //dd($this->role->namaRule == $namaRole);

    //     if($this->role->namaRule == $namaRole){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    // public function getRuleName($idRule){
    //     if($this->role->id == $idRule){
    //         return $this->role->namaRule;
    //     }else{
    //         return "NULL";
    //     }
    // }
}