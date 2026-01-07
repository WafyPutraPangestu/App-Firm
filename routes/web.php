<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});


foreach (glob(__DIR__ . '/web/*.php') as $routeFile) {
    require $routeFile;
}
