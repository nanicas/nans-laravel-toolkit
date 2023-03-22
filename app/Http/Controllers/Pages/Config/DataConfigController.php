<?php

namespace Zevitagem\LaravelToolkit\Http\Controllers\Pages\Config;

use Zevitagem\LaravelToolkit\Services\Config\DataConfigService;
use Illuminate\Http\Request;
use Zevitagem\LaravelToolkit\Helpers\Helper;

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
