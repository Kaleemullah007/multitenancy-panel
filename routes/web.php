<?php

use App\Http\Controllers\TenantController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::delete('tenant-permanently-deleted/{tenant}', [TenantController::class, 'deletePermanently'])->name('tenants.deleted');
    Route::delete('tenant-restore/{tenant}', [TenantController::class, 'restore'])->name('tenants.restored');
    Route::resource('tenants', TenantController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
