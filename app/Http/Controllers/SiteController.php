<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers;

use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\AbstractController;
use Zevitagem\LaravelSaasTemplateCore\Traits\AvailabilityWithService;

abstract class SiteController extends AbstractController
{
    use AvailabilityWithService;
    
    public function __construct()
    {
        $this->config['assets']['js'][] = 'js/site.js';
    }

    public function addIndexAssets()
    {
        return;
    }
}