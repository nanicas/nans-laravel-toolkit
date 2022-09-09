<?php

namespace App\Http\Controllers\Pages\Config;

use App\Http\Controllers\Pages\CrudController;
use App\Traits\IsConfigurationPageSection;
use App\Services\Config\DataConfigService;
use Illuminate\Http\Request;
use App\Helpers\Helper;

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
