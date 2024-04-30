<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::delete('user-permanently-deleted/{id}', [TenantController::class, 'deletePermanently'])->name('te.deleted');
Route::delete('user1-restore/{id}', [TenantController::class, 'restoreUser'])->name('te.restored');
Route::resource('tenants', TenantController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');