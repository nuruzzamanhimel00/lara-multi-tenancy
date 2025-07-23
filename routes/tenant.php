<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ProfileController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/tenant/', function () {
        // return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        return view("app.welcome");
    });
    // Route::get('/tenant-login', function(){
    //     dd('This is the tenant login page');
    // })->name('tenant.login');

    Route::middleware(['auth'])->prefix('tenant')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware([ 'verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Route::resource('users', TenantController::class);
    });

    require __DIR__.'/tenant-auth.php';

});
