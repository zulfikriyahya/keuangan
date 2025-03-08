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
        Schema::disableForeignKeyConstraints();

        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode')->nullable();
            $table->date('tanggal');
            $table->foreignId('tahun_id')->constrained('tahuns')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bulan_id')->constrained('bulans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('nominal');
            $table->string('kwitansi')->nullable();
            $table->foreignId('jenis_pengeluaran_id')->constrained('jenis_pengeluarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
