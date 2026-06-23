<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class galeriBkj extends Model
{
    // Inisialisasi nama tabel
    protected $table = 'galeri_bkj';

    // Inisialisasi primary key kustom
    protected $primaryKey = 'id_galeri_bkj';

    // Proteksi primary key agar tidak diisi manual via mass assignment
    protected $guarded = ['id_galeri_bkj'];

    public function bkj()
    {
        // Parameter: (NamaModelTarget, foreign_key_di_tabel_ini, owner_key_di_tabel_target)
        return $this->belongsTo(bkj::class, 'bkj_id', 'id_bkj');
    }
}
