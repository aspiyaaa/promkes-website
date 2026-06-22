<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    // Inisialisasi nama tabel
    protected $table = 'berita';

    // Inisialisasi primary key kustom
    protected $primaryKey = 'id_berita';

    // Proteksi primary key agar tidak diisi manual via mass assignment
    protected $guarded = ['id_berita'];
}
