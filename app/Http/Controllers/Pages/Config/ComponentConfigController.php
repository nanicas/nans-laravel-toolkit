<?php

namespace App\Http\Controllers\Pages\Config;

use App\Services\Config\ComponentConfigService;
use App\Http\Controllers\Pages\CrudController;
use App\Traits\IsConfigurationPageSection;

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
