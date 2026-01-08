<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats'; 
    protected $primaryKey = 'id_chat';
    
    protected $fillable = [
        'id_client',
        'guest_token', 
        'id_admin',
        'pengirim',
        'isi_pesan',
        'status_baca',
    ];

    
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }
}