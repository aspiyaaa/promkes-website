<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prestasi extends Model
{
    // inisialisasi tabel
    protected $table = 'prestasi';

    // inisialisasi prymary key
    protected $primaryKey = 'id_prestasi';

    // inisialisasi data yg tidak boleh diisi
    protected $guarded = ['id_prestasi'];
}
