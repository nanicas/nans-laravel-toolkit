<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages;

use Zevitagem\LaravelSaasTemplateCore\Services\Historic\HistoricService;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\CrudController;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

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
        
        $root = Helper::getRootFolderNameOfAssets();

        $this->config['assets']['js'][]  = $root . '/vendor/select2/js/select2.min.js';
        $this->config['assets']['css'][] = $root . '/vendor/select2/css/select2.min.css';
    }
}