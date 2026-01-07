<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ClientController;
use App\Http\Controllers\User\progresController;
use Illuminate\Support\Facades\DB;

Route::get('/test-invoice/{perkaraId}', function($perkaraId) {
    // Test 1: Cek table name
    $tables = DB::select('SHOW TABLES');
    dd($tables);
});

Route::middleware(['user'])->prefix('user')->name('user.')->group(function () {
    Route::controller(ClientController::class)->prefix('/clients')->name('clients.')->group(function () {
        Route::get('/{id}/dashboard', 'dashboard')->name('dashboard');
        Route::get('/{id}/detail', 'show')->name('show');
        // Download routes
        Route::get('/{id}/perkara/{perkaraId}/document/{documentId}/download', 'downloadDocument')->name('download.document');
        Route::get('/{id}/perkara/{perkaraId}/invoice/{invoiceId}/download', 'downloadInvoice')->name('download.invoice');
        // API untuk modal
        Route::get('/{id}/perkara/{perkaraId}/progress', 'getProgress')->name('get.progress');
        Route::get('/{id}/perkara/{perkaraId}/invoices', 'getInvoices')->name('get.invoices');
        Route::get('/{id}/perkara/{perkaraId}/documents', 'getDocuments')->name('get.documents');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(progresController::class)->prefix('/progres')->name('progres.')->group(function () {
        Route::get('/', 'index')->name('index');
        
    });

});
Route::controller(ClientController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    
});

Route::post('/user/clients/{id}/login', [ClientController::class, 'login'])->name('user.clients.login');