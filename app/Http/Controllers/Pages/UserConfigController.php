<?php

namespace App\Http\Controllers\Pages;

use App\Services\ConfigUserService;
use App\Http\Controllers\Pages\CrudController;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class UserConfigController extends CrudController
{
    public function __construct(ConfigUserService $service)
    {
        parent::__construct();

        $this->setService($service);
    }

    public function index(Request $request)
    {
        return $this->show($request, Helper::getUserId());
    }
}