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

        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npsn')->nullable();
            $table->string('nss')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('website')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->foreignId('pimpinan_id')->constrained('pimpinans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bendahara_id')->constrained('bendaharas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_bank')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};
