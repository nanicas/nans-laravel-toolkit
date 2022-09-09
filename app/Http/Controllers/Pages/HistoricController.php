<?php

namespace App\Http\Controllers\Pages;

use App\Services\Historic\HistoricService;
use App\Http\Controllers\Pages\CrudController;

class HistoricController extends CrudController
{
    public function __construct(HistoricService $service)
    {
        parent::__construct();

        $this->setService($service);
    }
    
    public function addFormAssets()
    {
        parent::addFormAssets();

        $this->config['assets']['js'][]  = 'vendor/select2/js/select2.min.js';
        $this->config['assets']['css'][] = 'vendor/select2/css/select2.min.css';
    }
}