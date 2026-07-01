<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi'); // Primary Key, Auto Increment
            $table->string('nama_pengirim')->nullable(); 
            $table->enum('status_peran', ['mahasiswa_aktif', 'dosen_staf', 'alumni', 'umum']);
            $table->enum('kategori_masukan', ['fasilitas_perkuliahan', 'kinerja_organisasi', 'teknis_website', 'lainnya']);
            $table->string('subjek'); // Judul/inti masukan singkat
            $table->text('isi_pesan'); // Tempat menampung pesan panjang
            $table->string('lampiran_file')->nullable(); // Menyimpan path/nama file saja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
