<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    
    // WAJIB ADA: Beritahu laravel kalau primary key kamu bernama id_ruangan
    protected $primaryKey = 'id_ruangan'; 

    protected $fillable = [
        'nama_ruangan',
        'kode_ruangan',
        'tipe_ruangan',
        'kapasitas',
        'lokasi',
        'fasilitas',
        'status',
        'foto_ruangan',
        'deskripsi'
    ];
}