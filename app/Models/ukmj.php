<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ukmj extends Model
{
    // Inisialisasi nama tabel
    protected $table = 'ukmj';

    // Inisialisasi primary key kustom
    protected $primaryKey = 'id_ukmj';

    // Proteksi primary key agar tidak diisi manual via mass assignment
    protected $guarded = ['id_ukmj'];
}
