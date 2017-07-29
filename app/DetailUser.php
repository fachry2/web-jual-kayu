<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $table = 'tbl_detail_users';

    public function user(){
        return $this->hasOne(User::class);
    }
}
