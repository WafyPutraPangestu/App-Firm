<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('client_id')) {
            return redirect()->route('client.login')
                ->with('error', 'Silakan masukkan Client Key');
        }

        $client = Client::find(session('client_id'));

        if (!$client) {
            session()->forget('client_id');
            abort(403, 'Client tidak ditemukan');
        }

        // optional: cek masa berlaku key
        if ($client->client_key_expired_at && Carbon::now()->greaterThan($client->client_key_expired_at)) {
            session()->forget('client_id');
            abort(403, 'Client Key sudah kadaluarsa');
        }

        return $next($request);
    }
}
