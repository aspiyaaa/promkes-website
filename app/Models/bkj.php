<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bkj extends Model
{
    // Inisialisasi nama tabel
    protected $table = 'badan_kelengkapan_jurusan';

    // Inisialisasi primary key kustom
    protected $primaryKey = 'id_bkj';

    // Proteksi primary key agar tidak diisi manual via mass assignment
    protected $guarded = ['id_bkj'];

    public function galeri()
    {
        return $this->hasMany(galeriBkj::class, 'bkj_id', 'id_bkj');
    }
}
