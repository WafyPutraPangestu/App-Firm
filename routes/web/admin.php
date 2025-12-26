<?php

use App\Http\Controllers\Admin\ClientController;
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
});