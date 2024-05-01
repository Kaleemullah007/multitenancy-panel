<?php

declare(strict_types=1);

use App\Http\Controllers\TenantController;
use App\Http\Controllers\Tenants\HomeController;
use App\Http\Controllers\Tenants\Permission\PermissionController;
use App\Http\Controllers\Tenants\Role\RoleController;
use App\Http\Controllers\Tenants\TenantUserController;
use App\Http\Middleware\RevalidateBackHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    RevalidateBackHistory::class,
])->group(function () {

    Auth::routes(['register' => false]);

    Route::get('/', function () {
        // dd(tenant()->toArray());
        return to_route('login');
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });


    // Route::resource('tenants', TenantUserController::class)->middleware('auth');
    Route::delete('user-permanently-deleted/{id}', [TenantUserController::class, 'deletePermanently'])->name('users.user-deleted');
    Route::delete('user-restore/{id}', [TenantUserController::class, 'restoreUser'])->name('users.user-restored');
    Route::get('user-manage-permission/{user}', [TenantUserController::class, 'mangePermissions'])->name('users.manage-permissions');
    Route::post('user-manage-permissions/{id}', [TenantUserController::class, 'savePermissions'])->name('users.save-permissions');
    Route::resource('users', TenantUserController::class)->middleware('auth');

    // Permission
    Route::delete('permission-permanently-deleted/{id}', [PermissionController::class, 'deletePermanently'])->name('permissions.user-deleted');
    Route::delete('permission-restore/{id}', [PermissionController::class, 'restoreUser'])->name('permissions.user-restored');
    Route::resource('permissions', PermissionController::class)->middleware('auth');
    // Role
    Route::delete('role-permanently-deleted/{id}', [RoleController::class, 'deletePermanently'])->name('roles.user-deleted');
    Route::delete('role-restore/{id}', [RoleController::class, 'restoreUser'])->name('roles.user-restored');
    Route::resource('roles', RoleController::class)->middleware('auth');


    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
})->middleware('auth');
