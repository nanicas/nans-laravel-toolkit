<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\Config\DataConfigService;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class_alias(Helper::readTemplateConfig()['controllers']['base_config'],  __NAMESPACE__ . '\BaseConfigControllerAlias');

class DataConfigController extends BaseConfigControllerAlias
{
    public function __construct(DataConfigService $service)
    {
        parent::__construct();

        $this->setService($service);
        $this->onConstructSection();
    }
    
    public function index(Request $request)
    {
        return parent::show($request, Helper::getSlug());
    }
}
