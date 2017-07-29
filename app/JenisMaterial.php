<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMaterial extends Model
{
    protected $table = 'jenis_material';

    public $timestamps = true;
    // use Notifiable;

    protected $fillable = [
        'material'
    ];
}
