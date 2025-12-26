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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')
      ->constrained('users')
      ->cascadeOnDelete();
    $table->foreignId('progres_perkara_id')->constrained()->cascadeOnDelete();

    $table->string('nomor_invoice')->unique();
    $table->decimal('jumlah', 15, 2);
    $table->text('keterangan')->nullable();

    $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
    $table->date('tanggal_invoice');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
