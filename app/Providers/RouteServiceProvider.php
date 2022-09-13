<?php

namespace Zevitagem\LaravelSaasTemplateCore\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as VendorServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as MainRouteServiceProvider;

class RouteServiceProvider extends VendorServiceProvider
{
    public const HOME = MainRouteServiceProvider::HOME;
    
    public function boot()
    {
        Route::namespace($this->namespace)
                ->group(base_path('routes/template_web.php'));
    }
}
