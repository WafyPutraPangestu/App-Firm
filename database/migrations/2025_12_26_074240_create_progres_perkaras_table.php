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
        Schema::create('progres_perkaras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')
      ->constrained('users')
      ->cascadeOnDelete();
            $table->foreignId('perkara_id')->constrained()->cascadeOnDelete();

            $table->string('judul_progres'); // Sidang 1, Sidang Putusan
            $table->text('keterangan')->nullable();
            $table->date('tanggal_progres');
            $table->integer('urutan'); // 1, 2, 3, ...
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_perkaras');
    }
};
