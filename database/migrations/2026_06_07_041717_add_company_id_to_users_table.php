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
        Schema::table('users', function (Blueprint $table) {
            // Menghubungkan pengguna/karyawan ke tabel perusahaan
            $table->foreignId('perusahaan_id')->after('id')->constrained('perusahaan')->onDelete('cascade');
            $table->string('peran')->default('karyawan'); // admin, hr, karyawan
            $table->unsignedInteger('gaji_pokok_awal')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
