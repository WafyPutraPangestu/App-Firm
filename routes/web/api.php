<?php

use App\Http\Controllers\Admin\DashboardController;
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
  Route::get('/api/clients/{client}/status', function (Client $client) {
    return response()->json([
        'status' => $client->status
    ]);
});
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
Route::controller(DashboardController::class)->prefix('admin')->name('admin.')->group(function () {
  Route::get('/api/realtime-stats', 'getRealtimeStats')->name('api.realtime-stats');
  Route::get('/api/stats-by-period', 'getStatsByPeriod')->name('api.stats-by-period');
  Route::get('/api/periode-breakdown', 'getPeriodeBreakdown')->name('api.periode-breakdown');
  Route::get('/api/search', 'search')->name('api.search');
  Route::get('/api/recent-activities', 'getRecentActivities')->name('api.recent-activities');
});
});

