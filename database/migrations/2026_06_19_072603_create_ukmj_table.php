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
        Schema::create('ukmj', function (Blueprint $table) {
            // Primary Key (Menggunakan id_ukmj agar serasi dengan gaya id_bkj milikmu)
            $table->id('id_ukmj'); 
            $table->string('nama_ukmj');
            $table->text('deskripsi');
            $table->string('logo')->nullable();
            $table->string('medsos')->nullable();
            
            // Kolom otomatis created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukmj');
    }
};
