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
        Schema::create('badan_kelengkapan_jurusan', function (Blueprint $table) {
            // Primary key menggunakan nama yang spesifik agar serasi dengan tabelmu yang lain
            $table->id('id_bkj'); 
            $table->string('nama_bkj', 150);
            $table->text('deskripsi');
            $table->string('logo')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badan_kelengkapan_jurusan');
    }
};
