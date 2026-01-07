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
        Schema::create('chat', function (Blueprint $table) {
            $table->id('id_chat'); 
            $table->unsignedBigInteger('id_client'); 
            $table->unsignedBigInteger('id_admin')->nullable(); 
            $table->enum('pengirim', ['client', 'admin']);
            $table->text('isi_pesan');
            $table->boolean('status_baca')->default(0);
            $table->timestamps();
            $table->foreign('id_client')
                  ->references('id')->on('clients')
                  ->onDelete('cascade'); 
            $table->foreign('id_admin')
                  ->references('id')->on('users') 
                  ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
