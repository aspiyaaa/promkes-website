<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel di database.
     */
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id(); // ID Berita (Primary Key)
            
            $table->string('title'); // Judul Berita
            $table->string('slug')->unique(); // URL unik (untuk SEO & link "Baca Lebih")
            $table->string('author')->default('Admin Promkes'); // Nama penulis berita
            $table->string('thumbnail')->nullable(); // Tempat menyimpan nama file foto/gambar
            
            $table->longText('content'); // Isi lengkap berita (yang nanti dipotong otomatis di beranda)
            $table->integer('views')->default(0); // Hitungan jumlah pembaca/viewer
            $table->enum('status', ['draft', 'published'])->default('draft'); // Status rilis berita
            
            $table->timestamps(); // Otomatis membuat kolom 'created_at' (untuk tanggal) & 'updated_at'
        });
    }

    /**
     * Batalkan migration (jika ingin rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};