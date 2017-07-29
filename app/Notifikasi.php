<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    public $timestamps = true;
    // use Notifiable;

    protected $fillable = [
        'id_usaha',
        'judul_notif',
        'pesan',
        'read'
    ];
}
