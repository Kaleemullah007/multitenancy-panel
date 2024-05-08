<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $loader = AliasLoader::getInstance();

        // Add your aliases

        $loader->alias('DataTables', Yajra\DataTables\Facades\DataTables::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-5');

        Paginator::defaultSimpleView('vendor.pagination.bootstrap-4');
    }
}
