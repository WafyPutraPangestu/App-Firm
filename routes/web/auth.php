<?php

use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::get('/login', [SessionController::class, 'showLoginForm'])->name('auth.login');
  Route::post('/login', [SessionController::class, 'login']);
  Route::get('/register', [SessionController::class, 'showRegisterForm'])->name('auth.register');
  Route::post('/register', [SessionController::class, 'register']);
});
