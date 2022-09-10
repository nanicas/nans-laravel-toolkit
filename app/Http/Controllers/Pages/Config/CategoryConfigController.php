<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\Config\CategoryConfigService;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\CrudController;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;

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