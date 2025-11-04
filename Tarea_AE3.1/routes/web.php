<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('principal');
});

Route::get('/principal', function () {
    return view('principal');
});

Route::post('/reserva', function () {
    return view('reserva');
});

Route::post('/login', function () {
    return view('login');
});

Route::post('/register', function () {
    return view('register');
});

Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');

Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');
