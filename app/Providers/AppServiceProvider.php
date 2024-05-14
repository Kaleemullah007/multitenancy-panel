<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Yajra\DataTables\Html\Builder;

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

        $loader->alias('Excel', Maatwebsite\Excel\Facades\Excel::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-5');
        // Builder::useVite();
        Paginator::defaultSimpleView('vendor.pagination.bootstrap-4');
    }
}
