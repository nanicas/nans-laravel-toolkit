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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/site/{slug?}', [App\Http\Controllers\Pages\SiteController::class, 'index'])->name('site');

$middlewares = Helper::defineLaravelWebMiddlewares(['web']);

Route::group(['middleware' => $middlewares],
    function () {

        Route::get('/home',
            [App\Http\Controllers\Pages\HomeController::class, 'index'])->name('home');

        Route::prefix('/scheduling')->group(function () {
            Route::get('/',
                [App\Libraries\Scheduling\SchedulingController::class, 'index'])->name('scheduling');

            Route::post('/filter',
                [App\Libraries\Scheduling\SchedulingController::class, 'filter'])->name('scheduling.filter');

            Route::get('/show/{id}',
                [App\Libraries\Scheduling\SchedulingController::class, 'show'])->name('scheduling.show');
        });

        Route::middleware(['admin'])->group(function () {

            //student
            Route::post('/{id}/turn_student', [App\Libraries\Scheduling\SchedulingController::class, 'turnStudent'])->name('scheduling.turn');
            Route::resource('student', App\Http\Controllers\Pages\StudentController::class)->only([
                'index', 'show', 'update'
            ]);

            //plan
            Route::get('/plan/modalities', [App\Http\Controllers\Pages\PlanController::class, 'modalities'])->name('plan.modalities');
            Route::resource('plan', App\Http\Controllers\Pages\PlanController::class);

            //modality
            Route::resource('modality', App\Http\Controllers\Pages\ModalityController::class);
        });

        Route::resource('user_config',
            App\Http\Controllers\Pages\UserConfigController::class)->only([
            'index', 'show', 'update', 'store'
        ]);

        Route::post('/application/generateLinkWithTempAuth',
            [App\Http\Controllers\Pages\ApplicationController::class, 'generateLinkWithTempAuth'])->name('generateLinkWithTempAuth');
    }
);
