<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PekerjaController; // Import controller

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pekerja', PekerjaController::class);
