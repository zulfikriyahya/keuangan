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

        Schema::create('jenis_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('akun_id')->constrained('akuns')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('kode')->nullable();
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
        Schema::dropIfExists('jenis_pengeluarans');
    }
};
