<?php

namespace App\Http\Controllers\Pages;

use App\Services\HomeService;
use App\Traits\AvailabilityWithService;
use App\Http\Controllers\DashboardController;

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

        return view('pages.home.index', $data);
    }

}
