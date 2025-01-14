<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('jenis_pembayaran_id')->constrained('jenis_pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('deskripsi')->nullable();
            $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('nominal');
            $table->string('kwitansi')->nullable();
            $table->enum('status', ["Lunas", "Terhutang"]);
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
