<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    // inisialisasi tabel
    protected $table = 'kategori_civitas';

    // inisialisasi prymary key
    protected $primaryKey = 'id_kategori';

    // inisialisasi data yg tidak boleh diisi
    protected $guarded = ['id_kategori'];
}
