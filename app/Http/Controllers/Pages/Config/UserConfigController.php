<?php

namespace App\Http\Controllers\Pages\Config;

use App\Services\ConfigUserService;
use App\Http\Controllers\Pages\CrudController;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Traits\IsConfigurationPageSection;

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
