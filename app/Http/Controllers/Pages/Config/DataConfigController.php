<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\CrudController;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;
use Zevitagem\LaravelSaasTemplateCore\Services\Config\DataConfigService;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class DataConfigController extends CrudController
{
    use IsConfigurationPageSection;

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
