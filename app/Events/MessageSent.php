<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // Wajib di-import
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Tambahkan "implements ShouldBroadcast"
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Terima data Chat yang baru dibuat
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Tentukan ke mana pesan ini akan dikirim (Channel)
     */
    public function broadcastOn(): array
    {
        // Logika Channel:
        // 1. Jika ini obrolan Client terdaftar -> Masuk ke channel 'chat.client.{id}'
        // 2. Jika ini obrolan Guest -> Masuk ke channel 'chat.guest.{token}'
        
        if ($this->chat->id_client) {
            // PrivateChannel butuh otentikasi (lebih aman)
            return [
                new PrivateChannel('chat.client.' . $this->chat->id_client)
            ];
        } else {
            // Channel publik untuk Guest (menggunakan token sebagai pembeda room)
            return [
                new Channel('chat.guest.' . $this->chat->guest_token)
            ];
        }
    }
    
    // Nama event yang akan didengar oleh Javascript (Opsional, defaultnya nama Class)
    public function broadcastAs()
    {
        return 'message.new';
    }
}