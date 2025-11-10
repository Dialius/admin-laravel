<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PekerjaController; // Import controller

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pekerja', PekerjaController::class);

Route::post('/pekerja/{id}/upload-profile', [PekerjaController::class, 'uploadProfile'])->name('pekerja.upload.profile');

// Route untuk admin profile
Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'showForm'])->name('admin.profile');
    Route::post('/admin/profile/upload', [AdminProfileController::class, 'uploadProfile'])->name('admin.profile.upload');
});