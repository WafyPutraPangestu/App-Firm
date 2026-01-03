<?php

use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::get('/login', [SessionController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [SessionController::class, 'login']);
});

Route::post('/logout', [SessionController::class, 'logout'])->name('auth.logout')->middleware('auth');
