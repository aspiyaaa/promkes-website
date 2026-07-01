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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('nim', 20);
            $table->string('program_studi')->default('Promosi Kesehatan');
            $table->string('nama_kompetisi');
            
            // Menggunakan enum untuk mengelompokkan tingkatan lomba
            $table->enum('tingkat', ['Nasional', 'Internasional']);
            
            // Pencapaian (Contoh: Juara 1, Juara Harapan, Finalis)
            $table->string('pencapaian'); 
            
            $table->year('tahun_prestasi');
            $table->string('penyelenggara'); // Nama instansi/panitia acara
            
            // Tempat menyimpan file sertifikat/foto piala (path URL)
            $table->string('bukti_prestasi')->nullable(); 
            
            $table->timestamps(); // Menghasilkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};