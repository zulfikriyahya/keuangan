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

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('tingkat', ['PAUD', 'TK', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->enum('jenjang', ['PAUD', 'TK', 'SD/MI', 'SMP/MTS', 'SMA/SMK/MA']);
            $table->foreignId('jurusan_id')->constrained('jurusans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
