<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\Config\ComponentConfigService;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\CrudController;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;

class ComponentConfigController extends CrudController
{

    use IsConfigurationPageSection;

    public function __construct(ComponentConfigService $service)
    {
        parent::__construct();

        $this->setService($service);
        $this->onConstructSection();
    }

}
