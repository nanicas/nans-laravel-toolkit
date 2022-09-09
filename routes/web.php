<?php

use Illuminate\Support\Facades\Route;
use Zevitagem\LegoAuth\Helpers\Helper;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

$middlewares = Helper::defineLaravelWebMiddlewares(['web'], $legoConfig);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/site/{slug?}', [App\Http\Controllers\Pages\SiteController::class, 'index'])->name('site');

Route::group(['middleware' => $middlewares],
        function () use ($legoConfig) {

            Route::get('/home',
                    [App\Http\Controllers\Pages\HomeController::class, 'index'])->name('home.index');

            Route::middleware(['admin'])->group(function () {
                Route::resource('historic', App\Http\Controllers\Pages\HistoricController::class);
            });

            Route::prefix('/config')->group(function () use ($legoConfig) {
                Route::get('/', function () {
                    return redirect()->route('dashboard_config.index');
                });
                
                //modality
                Route::resource('category_config', App\Http\Controllers\Pages\Config\CategoryConfigController::class);
                Route::resource('component_config', App\Http\Controllers\Pages\Config\ComponentConfigController::class);
                Route::get('/entity_config/dynamic_form',
                        [App\Http\Controllers\Pages\Config\EntityConfigController::class, 'dynamicFormByComponent'])->name('entity_config.dynamic_form');
                Route::resource('entity_config', App\Http\Controllers\Pages\Config\EntityConfigController::class);

                Route::get('/dashboard',
                        [App\Http\Controllers\Pages\Config\DashboardConfigController::class, 'index'])->name('dashboard_config.index');
                Route::get('/data',
                        [App\Http\Controllers\Pages\Config\DataConfigController::class, 'index'])->name('data_config.index');
                
                Route::resource('data_config', App\Http\Controllers\Pages\Config\DataConfigController::class)->only([
                    'index', 'show', 'update', 'store'
                ]);

                Route::resource('user_config',
                        App\Http\Controllers\Pages\Config\UserConfigController::class)->only([
                    'index', 'show', 'update', 'store'
                ])->withoutMiddleware([(isset($legoConfig['middlewares'])) ? $legoConfig['middlewares']['force_configured'] : null]);
            });
        }
);
