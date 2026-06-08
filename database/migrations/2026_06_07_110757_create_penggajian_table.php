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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->constrained('perusahaan')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('bulan_tahun'); // format: "06-2026"
            $table->unsignedInteger('gaji_pokok');
            $table->integer('tunjangan')->default(0);
            $table->integer('potongan')->default(0); // potongan terlambat / cuti
            $table->integer('gaji_bersih'); // hasil akhir kalkulator real-time
            $table->string('status_pembayaran')->default('belum_dibayar'); // belum_dibayar / dibayar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
