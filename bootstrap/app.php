<?php

use App\Http\Middleware\Localization;
use App\Http\Middleware\RevalidateBackHistory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use NunoMaduro\Collision\Provider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        
        // web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {

            $central_domains =  config('tenancy.central_domains');
            foreach ($central_domains as $domain) {
                Route::middleware('web')->domain($domain)
                    ->group(base_path('routes/web.php'));

                Route::prefix('api')->middleware(['api'])->domain($domain)
                ->group(base_path('routes/api.php'));
            }
        },

    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            RevalidateBackHistory::class
        ]);
        $middleware->web(append: [Localization::class]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            

        ]);
    
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
