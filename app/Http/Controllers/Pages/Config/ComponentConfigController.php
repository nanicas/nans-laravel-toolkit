<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\Config\ComponentConfigService;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class_alias(Helper::readTemplateConfig()['controllers']['base_config'],  __NAMESPACE__ . '\BaseConfigControllerAlias');

class ComponentConfigController extends BaseConfigControllerAlias
{
    public function __construct(ComponentConfigService $service)
    {
        parent::__construct();

        $this->setService($service);
        $this->onConstructSection();
    }

}
