<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function search(Request $request)
    {
        $query = Client::query();

        if ($request->q) {
            $query->where('jenis_client', 'like', "%{$request->q}%");
        }

        return response()->json([
            'data' => $query->select('jenis_client')
                ->distinct()
                ->limit(10)
                ->get()
        ]);
    }
}
