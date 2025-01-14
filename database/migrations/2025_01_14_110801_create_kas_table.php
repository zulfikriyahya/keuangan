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

        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('pembayaran_id')->constrained('pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pengeluaran_id')->constrained('pengeluarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pemasukan_id')->constrained('pemasukans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('saldo');
            $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
