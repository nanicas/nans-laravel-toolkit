<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController;
use App\Traits\AvailabilityWithService;

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