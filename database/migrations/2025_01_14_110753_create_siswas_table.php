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

        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('diterima_tanggal');
            $table->foreignId('diterima_dikelas')->constrained('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kelas_tahun_id')->constrained('kelas_tahuns')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ["Aktif", "Nonaktif"]);
            $table->string('foto')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('telepon')->nullable();
            $table->foreignId('kelas_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
