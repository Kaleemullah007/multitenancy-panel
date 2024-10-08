<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Tenants\PlanController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     // return view('welcome');
// <img src=" echo Storage::url('app/public/' . auth()->user()->tenant->file);/>

//     return redirect()->to(app()->getLocale());
// });

Route::get('localization/{locale}', [LocalizationController::class, 'index'])->name('localization');

Route::get('/dashboard', function () {
    // return view('home');
    return view('tenants.admin.dashboard');
});
Route::get('/signin', function () {
    // return view('home');
    return view('tenants.auth.signin');
});


Route::get('/contact-us', function () {
    // return view('home');
    return view('contact-us');
});



Route::get('/', function () {
    // return view('home');
    return to_route('login');
});
Route::get('captache', [ContactUsController::class, 'loadCapatche'])->name('contactus.loadCapatche');
Route::resource('/contactus', ContactUsController::class);

Auth::routes(
    ['register'=>false]
);

Route::middleware('auth')->group(function () {
    // Tenants
    Route::get('tenant-renew/{tenant}', [TenantController::class, 'renew'])->name('tenants.renew');
    Route::delete('tenant-permanently-deleted/{tenant}', [TenantController::class, 'deletePermanently'])->name('tenants.deleted');
    Route::delete('tenant-restore/{tenant}', [TenantController::class, 'restore'])->name('tenants.restored');
    Route::get('tenant-export-pdf', [TenantController::class, 'exportPdf'])->name('tenants.pdf');
    Route::resource('tenants', TenantController::class);

    // Tenant Import and export
    Route::get('/file-import', [HomeController::class, 'importView'])->name('file-import');
    Route::post('/import', [HomeController::class, 'import'])->name('import');
    Route::get('/export-users', [HomeController::class, 'exportUsers'])->name('export-users');



    //  Plan 
    Route::delete('plan-permanently-deleted/{tenant}', [PlanController::class, 'deletePermanently'])->name('plans.deleted');
    Route::delete('plan-restore/{tenant}', [PlanController::class, 'restore'])->name('plans.restored');
    Route::resource('plans', PlanController::class);


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/profile', ProfileController::class);
    Route::get('/contact-message', [ContactController::class, 'index'])->name('contact-message');
    Route::get('/reply', [ContactController::class, 'create'])->name('reply');
    Route::post('/reply', [ContactController::class, 'store'])->name('reply');
    Route::resource('/contacts', ContactController::class);

});
