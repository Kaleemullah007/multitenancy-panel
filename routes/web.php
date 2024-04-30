<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('tenants', TenantController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
