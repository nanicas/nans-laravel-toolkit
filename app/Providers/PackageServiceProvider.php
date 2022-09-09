<?php

namespace Zevitagem\LaravelSaasTemplateCore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Zevitagem\LaravelSaasTemplateCore\View\Components\DynamicEntityComponent;

class PackageServiceProvider extends ServiceProvider
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
        
        $src = __DIR__ . '/../../vendor/zevitagem/laravel-saas-template-core';
        
        $this->publishes([
            $src.'/resources/css' => resource_path('template/css'),
        ], 'template_core');
        
        $this->publishes([
            $src.'/resources/js' => resource_path('template/js'),
        ], 'template_core');
        
        $this->publishes([
            $src.'/resources/sass' => resource_path('template/sass'),
        ], 'template_core');
        
        $this->publishes([
            $src . '/public' => public_path('template')
        ], 'template_core');
        
        $this->loadViewsFrom($src.'/resources/views', 'template_core');
    }
}
