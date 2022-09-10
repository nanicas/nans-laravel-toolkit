<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers;

use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\AbstractController;
use Zevitagem\LaravelSaasTemplateCore\Traits\AvailabilityWithService;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

abstract class SiteController extends AbstractController
{
    use AvailabilityWithService;
    
    public function __construct()
    {
        $root = Helper::getRootFolderNameOfAssets();
        
        $this->config['assets']['js'][] = $root . '/js/site.js';
    }

    public function addIndexAssets()
    {
        return;
    }
}