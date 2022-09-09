<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController;
use Illuminate\Support\Facades\View;
use App\Helpers\Helper;
use Illuminate\Http\Request;

abstract class DashboardController extends AbstractController
{
    protected bool $allowed = true;

    public function __construct()
    {
        parent::__construct();

        $this->config['assets']['js'][] = 'js/dashboard.js';
    }

    protected function allowed(bool $value)
    {
        $this->allowed = $value;
    }

    protected function isAllowed(): bool
    {
        return $this->allowed;
    }

    protected function notAllowedResponse(Request $request)
    {
        return Helper::notAllowedResponse($request);
    }
    
    public function beforeView()
    {
        $sessionData = Helper::getSessionData();

        View::share('session_data', $sessionData);
        View::share('is_admin', Helper::isAdmin());
        View::share('is_master', Helper::isMaster());

        parent::beforeView();
    }
}