<?php

return [
    'helpers' => [
        'global' => App\Helpers\Helper::class,
    ],
    'controllers' => [
        'dashboard' => App\Http\Controllers\DashboardController::class,
        'crud' => App\Http\Controllers\Pages\CrudController::class,
        'login' => App\Http\Controllers\Auth\LoginController::class,
        'base' => App\Http\Controllers\Controller::class,
        'site' => App\Http\Controllers\SiteController::class,
        'base_config' => App\Http\Controllers\Pages\Config\BaseConfigController::class,
    ]
];
