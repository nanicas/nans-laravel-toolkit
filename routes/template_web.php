<?php

use Illuminate\Support\Facades\Route;
use Zevitagem\LegoAuth\Helpers\Helper;

$middlewares = Helper::defineLaravelWebMiddlewares(['web'], $legoConfig);

Route::get('/site/{slug?}', [Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\SiteController::class, 'index'])->name('site');

Route::group(['middleware' => $middlewares],
        function () use ($legoConfig) {

            Route::get('/home', [Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\HomeController::class, 'index'])->name('home.index');
            Route::resource('historic', Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\HistoricController::class);

            Route::prefix('/config')->group(function () use ($legoConfig) {

                Route::middleware(['admin'])->group(function () {

                    Route::resource('category_config', Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config\CategoryConfigController::class);
                    Route::resource('component_config', Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config\ComponentConfigController::class);

                    Route::get('/entity_config/dynamic_form',
                            [Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config\EntityConfigController::class, 'dynamicFormByComponent'])->name('entity_config.dynamic_form');
                    Route::resource('entity_config', Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config\EntityConfigController::class);

                    Route::resource('data_config', Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config\DataConfigController::class)->only([
                        'index', 'show', 'update', 'store'
                    ]);
                });

                Route::resource('user_config', Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config\UserConfigController::class)->only([
                    'index', 'show', 'update', 'store'
                ])->withoutMiddleware([(isset($legoConfig['middlewares'])) ? $legoConfig['middlewares']['force_configured'] : null]);
            });
        }
);
