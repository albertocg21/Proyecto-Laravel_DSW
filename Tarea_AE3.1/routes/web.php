<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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