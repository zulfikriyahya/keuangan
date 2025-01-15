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

        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_id')->constrained('tahuns')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('bulan_id')->constrained('bulans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
};
