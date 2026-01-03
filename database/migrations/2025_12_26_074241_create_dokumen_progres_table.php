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
        Schema::create('dokumen_progres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')
      ->constrained('users')
      ->cascadeOnDelete();
            $table->foreignId('progres_perkara_id')->constrained()->cascadeOnDelete();
            $table->string('nama_dokumen');
            $table->string('file_path');
            $table->string('tipe_dokumen'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_progres');
    }
};
