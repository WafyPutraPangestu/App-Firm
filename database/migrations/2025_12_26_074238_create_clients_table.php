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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')
      ->constrained('users')
      ->cascadeOnDelete();
      $table->string('nama_lengkap');
      $table->string('email')->unique();
      $table->string('no_hp');
      $table->text('alamat')->nullable();
      $table->string('nik')->nullable();
  
      // Akses client (dibuat SETELAH perkara pertama sah)
      $table->string('client_key')->unique()->nullable();
      $table->timestamp('client_key_expired_at')->nullable();
  
      // Status client
      $table->enum('status', ['pending', 'aktif'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
