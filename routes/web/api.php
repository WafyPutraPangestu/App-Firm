<?php

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/clients/search', function (Request $request) {
  $q = strtolower($request->q ?? '');

  $data = collect([
    ['jenis_client' => 'retainer'],
    ['jenis_client' => 'litigasi'],
    ['jenis_client' => 'non_litigasi'],
  ])->filter(
    fn($item) =>
    str_contains($item['jenis_client'], $q)
  )->values();

  return response()->json([
    'data' => $data
  ]);
});

Route::middleware('admin')->group(function () {
  Route::put('/api/clients/{client}/update-status', function (Request $request, Client $client) {
    
    $request->validate([
        'status' => 'required|string'
    ]);

  
    $client->update(['status' => $request->status]);

    return response()->json([
        'message' => 'Status berhasil diubah',
        'status' => $client->status
    ]);
});
});

