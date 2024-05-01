<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\TenantController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->to(app()->getLocale());
});

Route::get('localization/{locale}', [LocalizationController::class, 'index'])->name('localization');


Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::delete('tenant-permanently-deleted/{tenant}', [TenantController::class, 'deletePermanently'])->name('tenants.deleted');
    Route::delete('tenant-restore/{tenant}', [TenantController::class, 'restore'])->name('tenants.restored');
    Route::resource('tenants', TenantController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});