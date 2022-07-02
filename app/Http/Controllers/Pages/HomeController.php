<?php

namespace App\Http\Controllers\Pages;

use App\Services\HomeService;
use App\Http\Controllers\AbstractController;
use \App\Traits\AvailabilityWithService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Helpers\Helper;

class HomeController extends DashboardController
{
    use AvailabilityWithService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeService $homeService)
    {
        parent::__construct();

        $this->setService($homeService);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Auth::logout();
        //dd(Auth::check());
        //echo json_encode(session()->all()['auth']);
        //dd(session()->all());
        //dd(Helper::isMaster());

        $this->addIndexAssets();
        $this->beforeView();

        $data = $this->service->getIndexData();

        return view('pages.home.index', $data);
        //return view('layouts.test', $data);
    }
}