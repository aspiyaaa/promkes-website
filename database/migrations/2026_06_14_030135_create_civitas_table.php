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
        Schema::create('civitas_akademik', function (Blueprint $table) {
            $table->id('id_civitas');
            $table->string('nama_lengkap', 150);
            $table->string('nip', 30);
            $table->string('pangkat_golongan', 50);
            $table->string('jabatan', 100);
            $table->string('foto', 255);
            $table->string('motto', 255)->nullable();

            // Bagian SMA
            $table->string('sma_nama', 150);
            $table->year('sma_tahun_lulus');

            // Bagian D3
            $table->string('d3_universitas', 150)->nullable();
            $table->year('d3_tahun_lulus')->nullable();

            // Bagian S1 / D4
            $table->string('s1_universitas', 150)->nullable();
            $table->string('s1_prodi', 150)->nullable();
            $table->string('s1_peminatan', 150)->nullable();
            $table->year('s1_tahun_lulus')->nullable();

            // Bagian S2
            $table->string('s2_universitas', 150)->nullable();
            $table->string('s2_prodi', 150)->nullable();
            $table->string('s2_peminatan', 150)->nullable();
            $table->year('s2_tahun_lulus')->nullable();

            // Bagian S3
            $table->string('s3_universitas', 150)->nullable();
            $table->string('s3_prodi', 150)->nullable();
            $table->string('s3_peminatan', 150)->nullable();
            $table->year('s3_tahun_lulus')->nullable();

            // created_at dan updated_at otomatis dibuat sebagai TIMESTAMP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civitas');
    }
};
