<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PerkaraController;
use App\Http\Controllers\Admin\ProgresController;
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
    });

    Route::controller(PerkaraController::class)
    ->prefix('admin/perkaras')
    ->name('admin.perkara.')
    ->group(function () {
        Route::get('/{perkara}/client/{client}', 'show')->name('show');
        Route::get('/create/{client}', 'create')->name('create');
        Route::post('/{client}', 'store')->name('store');
    });

    Route::controller(ProgresController::class)
    ->prefix('admin/progres')
    ->name('admin.progres.')
    ->group(function () {
       Route::get('/{perkara}/client/{client}', 'create')->name('create');
       Route::post('/{perkara}/{client}', 'store')->name('store');
    });

});
