<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Client;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Guest mengirim pesan (anonymous)
     * POST /api/chat/guest/send
     */
    public function adminChatPage()
    {
    return view('admin.chat.index');
    }

    public function sendGuestMessage(Request $request)
    {
        $request->validate([
            'guest_token' => 'required|string',
            'isi_pesan' => 'required|string',
        ]);

        try {
            $chat = Chat::create([
                'guest_token' => $request->guest_token,
                'pengirim' => 'guest',
                'isi_pesan' => $request->isi_pesan,
                'status_baca' => false,
            ]);

            // Broadcast event
            broadcast(new MessageSent($chat))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim',
                'data' => $chat
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending guest message: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan'
            ], 500);
        }
    }

    /**
     * Client mengirim pesan
     * POST /api/chat/client/send
     */
    public function sendClientMessage(Request $request)
    {
        $request->validate([
            'id_client' => 'required|exists:clients,id',
            'isi_pesan' => 'required|string',
        ]);

        try {
            $chat = Chat::create([
                'id_client' => $request->id_client,
                'pengirim' => 'client',
                'isi_pesan' => $request->isi_pesan,
                'status_baca' => false,
            ]);

            // Broadcast event
            broadcast(new MessageSent($chat))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim',
                'data' => $chat
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending client message: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan'
            ], 500);
        }
    }

    /**
     * Admin mengirim pesan balasan ke guest
     * POST /api/chat/admin/reply-guest
     */
    public function replyToGuest(Request $request)
    {
        $request->validate([
            'guest_token' => 'required|string',
            'isi_pesan' => 'required|string',
        ]);

        try {
            $chat = Chat::create([
                'guest_token' => $request->guest_token,
                'id_admin' => Auth::id(),
                'pengirim' => 'admin',
                'isi_pesan' => $request->isi_pesan,
                'status_baca' => false,
            ]);

            // Broadcast event
            broadcast(new MessageSent($chat))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Balasan berhasil dikirim',
                'data' => $chat
            ]);
        } catch (\Exception $e) {
            Log::error('Error replying to guest: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim balasan'
            ], 500);
        }
    }

    /**
     * Admin mengirim pesan balasan ke client
     * POST /api/chat/admin/reply-client
     */
    public function replyToClient(Request $request)
    {
        $request->validate([
            'id_client' => 'required|exists:clients,id',
            'isi_pesan' => 'required|string',
        ]);

        try {
            $chat = Chat::create([
                'id_client' => $request->id_client,
                'id_admin' => Auth::id(),
                'pengirim' => 'admin',
                'isi_pesan' => $request->isi_pesan,
                'status_baca' => false,
            ]);

            // Broadcast event
            broadcast(new MessageSent($chat))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Balasan berhasil dikirim',
                'data' => $chat
            ]);
        } catch (\Exception $e) {
            Log::error('Error replying to client: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim balasan'
            ], 500);
        }
    }

    /**
     * Ambil history chat guest
     * GET /api/chat/guest/{guest_token}
     */
    public function getGuestMessages($guest_token)
    {
        try {
            $messages = Chat::where('guest_token', $guest_token)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $messages
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting guest messages: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil pesan'
            ], 500);
        }
    }

    /**
     * Ambil history chat client
     * GET /api/chat/client/{id_client}
     */
    public function getClientMessages($id_client)
    {
        try {
            $messages = Chat::where('id_client', $id_client)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $messages
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting client messages: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil pesan'
            ], 500);
        }
    }

    /**
     * Admin: Ambil semua conversation (guest + client)
     * GET /api/chat/admin/conversations
     */
    public function getAdminConversations()
    {
        try {
            // Ambil semua guest conversations
            $guestConversations = Chat::whereNotNull('guest_token')
                ->select('guest_token')
                ->selectRaw('MAX(created_at) as last_message_at')
                ->selectRaw('SUM(CASE WHEN status_baca = 0 AND pengirim != "admin" THEN 1 ELSE 0 END) as unread_count')
                ->groupBy('guest_token')
                ->orderBy('last_message_at', 'desc')
                ->get()
                ->map(function($item) {
                    $lastMessage = Chat::where('guest_token', $item->guest_token)
                        ->orderBy('created_at', 'desc')
                        ->first();
                    
                    return [
                        'type' => 'guest',
                        'guest_token' => $item->guest_token,
                        'name' => 'Guest ' . substr($item->guest_token, 0, 8),
                        'last_message' => $lastMessage->isi_pesan,
                        'last_message_at' => $item->last_message_at,
                        'unread_count' => $item->unread_count,
                    ];
                });

            // Ambil semua client conversations
            $clientConversations = Chat::whereNotNull('id_client')
                ->with('client:id,nama_lengkap,email')
                ->select('id_client')
                ->selectRaw('MAX(created_at) as last_message_at')
                ->selectRaw('SUM(CASE WHEN status_baca = 0 AND pengirim != "admin" THEN 1 ELSE 0 END) as unread_count')
                ->groupBy('id_client')
                ->orderBy('last_message_at', 'desc')
                ->get()
                ->map(function($item) {
                    $lastMessage = Chat::where('id_client', $item->id_client)
                        ->orderBy('created_at', 'desc')
                        ->first();
                    
                    return [
                        'type' => 'client',
                        'id_client' => $item->id_client,
                        'name' => $item->client->nama_lengkap ?? 'Unknown Client',
                        'email' => $item->client->email ?? '',
                        'last_message' => $lastMessage->isi_pesan,
                        'last_message_at' => $item->last_message_at,
                        'unread_count' => $item->unread_count,
                    ];
                });

            // Gabungkan dan sort berdasarkan waktu terbaru
            $allConversations = $guestConversations->concat($clientConversations)
                ->sortByDesc('last_message_at')
                ->values();

            return response()->json([
                'success' => true,
                'data' => $allConversations
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting admin conversations: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil conversations'
            ], 500);
        }
    }

    /**
     * Mark messages as read
     * POST /api/chat/mark-read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'guest_token' => 'nullable|string',
            'id_client' => 'nullable|exists:clients,id',
        ]);

        try {
            $query = Chat::where('status_baca', false);

            if ($request->guest_token) {
                $query->where('guest_token', $request->guest_token);
            } elseif ($request->id_client) {
                $query->where('id_client', $request->id_client);
            }

            $query->update(['status_baca' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan ditandai sudah dibaca'
            ]);
        } catch (\Exception $e) {
            Log::error('Error marking messages as read: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai pesan'
            ], 500);
        }
    }

    /**
     * Generate guest token untuk anonymous user
     * GET /api/chat/generate-guest-token
     */
    public function generateGuestToken()
    {
        $token = Str::random(32);
        
        return response()->json([
            'success' => true,
            'guest_token' => $token
        ]);
    }
}