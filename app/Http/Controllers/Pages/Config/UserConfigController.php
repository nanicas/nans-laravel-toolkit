<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\ConfigUserService;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\CrudController;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;

class UserConfigController extends CrudController
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
