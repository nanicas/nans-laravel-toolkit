<?php

namespace Zevitagem\LaravelSaasTemplateCore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Zevitagem\LaravelSaasTemplateCore\View\Components\DynamicEntityComponent;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        Blade::component('package-dynamic-entity-component', DynamicEntityComponent::class);
        
        $src = __DIR__ . '/../..';
        
        $this->publishes([
            $src.'/resources/css' => resource_path('template/css'),
        ], 'template_core:resources');
        
        $this->publishes([
            $src.'/resources/js' => resource_path('template/js'),
        ], 'template_core:resources');
        
        $this->publishes([
            $src.'/resources/sass' => resource_path('template/sass'),
        ], 'template_core:resources');
        
        $this->publishes([
            $src . '/public' => public_path('template')
        ], 'template_core:public');
        
        $this->publishes([
            $src.'/routes' => base_path('routes'),
        ], 'template_core:routes');
        
        $this->loadViewsFrom($src.'/resources/views', 'template_core');
    }
}
