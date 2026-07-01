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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id('id_ruangan');
            $table->string('nama_ruangan'); 
            $table->string('kode_ruangan')->unique(); 
            $table->enum('tipe_ruangan', ['kelas', 'laboratorium', 'aula'])->default('kelas');
            $table->integer('kapasitas'); 
            $table->string('lokasi'); 
            $table->text('fasilitas'); // Di sini diisi AC, Proyektor, Alat Lab, dll.
            $table->enum('status', ['tersedia', 'digunakan', 'perbaikan'])->default('tersedia'); 
            $table->string('foto_ruangan')->nullable(); 
            $table->text('deskripsi')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
