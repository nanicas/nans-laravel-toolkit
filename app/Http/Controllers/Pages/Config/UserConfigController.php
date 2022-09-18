<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\ConfigUserService;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class_alias(Helper::readTemplateConfig()['controllers']['base_config'],  __NAMESPACE__ . '\BaseConfigControllerAlias');

class UserConfigController extends BaseConfigControllerAlias
{
    use IsConfigurationPageSection;

    public function __construct(ConfigUserService $service)
    {
        parent::__construct();

        $this->setService($service);
        $this->onConstructSection();
    }

    public function index(Request $request)
    {
        return $this->show($request, Helper::getUserId());
    }
}
