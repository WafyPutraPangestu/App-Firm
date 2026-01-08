<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn(): array
    {
        $channels = [];
        
        // Channel untuk admin (semua admin bisa lihat)
        $channels[] = new PrivateChannel('chat.admin');
        
        // Channel untuk client/guest
        if ($this->chat->id_client) {
            // Kalau ada id_client, kirim ke channel client
            $channels[] = new PrivateChannel('chat.client.' . $this->chat->id_client);
        } elseif ($this->chat->guest_token) {
            // Kalau guest, kirim ke channel guest (public channel)
            $channels[] = new Channel('chat.guest.' . $this->chat->guest_token);
        }
        
        return $channels;
    }
    
    public function broadcastAs()
    {
        return 'message.new';
    }
    
    // Data yang dikirim ke frontend
    public function broadcastWith()
    {
        return [
            'id_chat' => $this->chat->id_chat,
            'id_client' => $this->chat->id_client,
            'guest_token' => $this->chat->guest_token,
            'id_admin' => $this->chat->id_admin,
            'pengirim' => $this->chat->pengirim,
            'isi_pesan' => $this->chat->isi_pesan,
            'status_baca' => $this->chat->status_baca,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
    }
}