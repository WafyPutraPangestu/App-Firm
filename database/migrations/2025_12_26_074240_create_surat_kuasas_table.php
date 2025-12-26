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
        Schema::create('surat_kuasas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploaded_by')
      ->constrained('users')
      ->cascadeOnDelete();
      $table->foreignId('perkara_id')->constrained()->cascadeOnDelete();

      $table->string('nomor_surat')->nullable();
      $table->date('tanggal_surat');
      $table->string('file_path');
  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kuasas');
    }
};
