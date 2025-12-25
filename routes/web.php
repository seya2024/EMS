<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Later you try to define this
Route::get('/', [HomeController::class, 'index']);

Route::get('/', function () {
    return view('home');
});
