<?php
return [
    'middlewares' => [
        'auth_filler_middleware' => Zevitagem\LegoAuth\Middlewares\AuthFillerMiddleware::class,
        'authenticable_middleware' => Zevitagem\LegoAuth\Middlewares\AuthenticateMiddleware::class,
    ],
    'models' => [
        'user' => \App\Models\User::class,
        'config_user' => \App\Models\ConfigUser::class,

        'application' => \Zevitagem\LegoAuth\Models\Laravel\ApplicationL::class,
        'authorization' => \Zevitagem\LegoAuth\Models\Laravel\AuthorizationL::class,
        'contract' => \Zevitagem\LegoAuth\Models\Laravel\ContractL::class,
        'slug' => \Zevitagem\LegoAuth\Models\Laravel\SlugL::class,
    ],
    'api_group' => 'api',
    'config_user_api' => \Zevitagem\LegoAuth\Controllers\Api\ConfigUserApiController::class,
    'user_api' => \Zevitagem\LegoAuth\Controllers\Api\UserApiController::class,
    'is_sourcer' => false,
    'is_laravel' => true,
    'package' => 'anc',
    'pages' => [
        'user_config' => true
    ],
    'slugs_inside' => false
];