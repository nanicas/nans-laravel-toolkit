<?php

use Illuminate\Support\Facades\Route;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

$middlewares = Helper::defineLaravelWebMiddlewares(['web'], $legoConfig);

Route::get('/site/{slug?}', [Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\SiteController::class, 'index'])->name('site');

Route::group(['middleware' => $middlewares],
        function () use ($legoConfig) {

            Route::get('/home',
                    [Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\HomeController::class, 'index'])->name('home.index');

            Route::middleware(['admin'])->group(function () {

                Route::resource('historic', Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\HistoricController::class);
            });

            Route::prefix('/config')->group(function () use ($legoConfig) {
                Route::get('/', function () {
                    return redirect()->route('dashboard_config.index');
                });

                Route::resource('category_config', Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\CategoryConfigController::class);
                Route::resource('component_config', Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\ComponentConfigController::class);
                
                Route::resource('entity_config', Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\EntityConfigController::class);
                Route::get('/entity_config/dynamic_form',
                        [Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\EntityConfigController::class, 'dynamicFormByComponent'])->name('entity_config.dynamic_form');

                Route::get('/dashboard',
                        [Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\DashboardConfigController::class, 'index'])->name('dashboard_config.index');
                Route::get('/data',
                        [Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\DataConfigController::class, 'index'])->name('data_config.index');

                Route::resource('data_config', Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\DataConfigController::class)->only([
                    'index', 'show', 'update', 'store'
                ]);

                Route::resource('user_config',
                        Zevitagem\LaravelSaasTemplateCore\Controllers\Pages\Config\UserConfigController::class)->only([
                    'index', 'show', 'update', 'store'
                ])->withoutMiddleware([(isset($legoConfig['middlewares'])) ? $legoConfig['middlewares']['force_configured'] : null]);
            });
        }
);
