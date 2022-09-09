<?php

namespace App\Http\Controllers\Pages\Config;

use App\Services\Config\CategoryConfigService;
use App\Http\Controllers\Pages\CrudController;
use App\Traits\IsConfigurationPageSection;

class CategoryConfigController extends CrudController
{
    use IsConfigurationPageSection;
    
    public function __construct(CategoryConfigService $service)
    {
        parent::__construct();

        $this->setService($service);
        $this->onConstructSection();
    }
}