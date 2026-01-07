<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PerkaraController;
use App\Http\Controllers\Admin\ProgresController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::controller(ClientController::class)->prefix('admin/clients')->name('admin.clients.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{client}', 'show')->name('show');
        Route::get('/{client}/edit', 'edit')->name('edit');
        Route::put('/{client}', 'update')->name('update');
        Route::delete('/{client}', 'destroy')->name('destroy');
        Route::post('/{client}', 'generateKey')->name('generateKey');
    });
    Route::controller(PerkaraController::class)
    ->prefix('admin/perkaras')
    ->name('admin.perkara.')
    ->group(function () {
        Route::get('/{perkara}/client/{client}', 'show')->name('show');
        Route::get('/create/{client}', 'create')->name('create');
        Route::post('/{client}', 'store')->name('store');
        Route::patch('/clients/{client}/perkara/{perkara}/finish', 
        [PerkaraController::class, 'finish']
    )->name('finish');
        Route::patch('/clients/{client}/perkara/{perkara}/reopen', 
        [PerkaraController::class, 'reopen']
    )->name('reopen');
    });

    Route::controller(ProgresController::class)
    ->prefix('admin/progres')
    ->name('admin.progres.')
    ->group(function () {
       Route::get('/{perkara}/client/{client}', 'create')->name('create');
       Route::post('/{perkara}/client/{client}', 'store')->name('store');
       Route::patch('/{invoice}/toggle-status', 
        [ProgresController::class, 'toggleStatus']
        )->name('toggle-status');
        Route::get('/{invoice}/download', 
        [ProgresController::class, 'download']
        )->name('download');
       
    });

});
