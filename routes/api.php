<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Guest Chat (Anonymous)
Route::prefix('chat/guest')->group(function () {
    Route::get('/generate-token', [ChatController::class, 'generateGuestToken']);
    Route::post('/send', [ChatController::class, 'sendGuestMessage']);
    Route::get('/{guest_token}', [ChatController::class, 'getGuestMessages']);
});

// Client Chat
Route::prefix('chat/client')->group(function () {
    Route::post('/send', [ChatController::class, 'sendClientMessage']);
    Route::get('/{id_client}', [ChatController::class, 'getClientMessages']);
});

// Admin Chat (perlu authentication)
// Route::middleware('auth:sanctum')->prefix('chat/admin')->group(function () {
//     Route::post('/reply-guest', [ChatController::class, 'replyToGuest']);
//     Route::post('/reply-client', [ChatController::class, 'replyToClient']);
//     Route::get('/conversations', [ChatController::class, 'getAdminConversations']);
// });

// Mark as read (bisa diakses guest, client, admin)
Route::post('chat/mark-read', [ChatController::class, 'markAsRead']);