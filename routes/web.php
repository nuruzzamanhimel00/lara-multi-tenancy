<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {

    return view('welcome');
});



Route::middleware(['auth','prevent-tenant-on-central'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware([ 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tenants', TenantController::class);
});

require __DIR__.'/auth.php';
