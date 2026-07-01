<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aspirasi extends Model
{
    protected $table = 'aspirasi';

    protected $primaryKey = 'id_aspirasi';

    protected $guarded = ['id_aspirasi'];

    protected $fillable = [
        'nama_pengirim',
        'status_peran',
        'kategori_masukan',
        'subjek',
        'isi_pesan',
        'lampiran_file'
    ];
}
