<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah ada session client_id
        if (!session()->has('client_id')) {
            // Jika request AJAX, return JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu'
                ], 401);
            }
            
            // Jika bukan AJAX, redirect ke halaman index dengan pesan error
            return redirect()->route('index')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Cari client berdasarkan session
        $client = Client::find(session('client_id'));

        // Jika client tidak ditemukan
        if (!$client) {
            session()->forget(['client_id', 'client_name']);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client tidak ditemukan'
                ], 404);
            }
            
            return redirect()->route('index')
                ->with('error', 'Client tidak ditemukan');
        }

        // Cek status client
        if ($client->status !== 'aktif') {
            session()->forget(['client_id', 'client_name']);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun client tidak aktif'
                ], 403);
            }
            
            return redirect()->route('index')
                ->with('error', 'Akun client tidak aktif');
        }

        // Cek masa berlaku client key
        if ($client->client_key_expired_at && Carbon::now()->greaterThan($client->client_key_expired_at)) {
            session()->forget(['client_id', 'client_name']);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client Key sudah kadaluarsa'
                ], 403);
            }
            
            return redirect()->route('index')
                ->with('error', 'Client Key sudah kadaluarsa');
        }

        // Simpan data client ke request agar bisa diakses di controller
        $request->merge(['authenticated_client' => $client]);

        return $next($request);
    }
}