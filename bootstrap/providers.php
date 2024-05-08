<?php

use App\Providers\TenancyServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    TenancyServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    Yajra\DataTables\DataTablesServiceProvider::class,
];
