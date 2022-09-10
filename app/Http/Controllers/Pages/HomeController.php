<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages;

use Zevitagem\LaravelSaasTemplateCore\Services\HomeService;
use Zevitagem\LaravelSaasTemplateCore\Traits\AvailabilityWithService;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\DashboardController;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class HomeController extends DashboardController
{
    use AvailabilityWithService;

    public function __construct(HomeService $homeService)
    {
        parent::__construct();

        $this->setService($homeService);
    }

    public function index()
    {
        $this->addIndexAssets();
        $this->beforeView();

        $data = $this->service->getIndexData();

        return Helper::view('pages.home.index', $data);
    }

}
