<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class civitas extends Model
{
    // inisialisasi tabel
    protected $table = 'civitas_akademik';

    // inisialisasi prymary key
    protected $primaryKey = 'id_civitas';

    // inisialisasi data yg tidak boleh diisi
    protected $guarded = ['id_civitas'];

    public function kategori()
    {
        // Parameter: (NamaModelTarget, foreign_key_di_tabel_ini, owner_key_di_tabel_target)
        return $this->belongsTo(kategori::class, 'kategori_id', 'id_kategori');
    }

}
