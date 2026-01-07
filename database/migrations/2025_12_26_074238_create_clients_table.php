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
            $table->string('nama_perusahaan');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->text('alamat')->nullable();
            // $table->string('nik')->nullable();
            $table->enum('jenis_client', ['retainer', 'litigasi', 'non_litigasi'])->default('non_litigasi');


            $table->string('client_key')->unique()->nullable();
            $table->timestamp('client_key_expired_at')->nullable();


            $table->enum('status', ['nonaktif', 'aktif'])->default('aktif');
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
