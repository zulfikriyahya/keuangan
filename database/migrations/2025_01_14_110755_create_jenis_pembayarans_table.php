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

        Schema::create('jenis_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('akun_id')->constrained('akuns')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tahun_id')->constrained('tahuns')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('kode')->nullable();
            $table->foreignId('jurusan_id')->constrained('jurusans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('deskripsi')->nullable();
            $table->unsignedInteger('nominal');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pembayarans');
    }
};
