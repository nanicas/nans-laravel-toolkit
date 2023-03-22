<?php

namespace Zevitagem\LaravelToolkit\Http\Controllers;

use Illuminate\Support\Facades\View;
use Zevitagem\LaravelToolkit\Helpers\Helper;
use Illuminate\Http\Request;

class_alias(Helper::readTemplateConfig()['controllers']['base'],  __NAMESPACE__ . '\BaseControllerAlias');

abstract class DashboardController extends BaseControllerAlias
{
    protected bool $allowed = true;

    public function __construct()
    {
        parent::__construct();

        $root = $this->getRootFolderNameOfAssetsPackaged();

        $this->config['assets']['js'][] = $root . '/js/dashboard.js';
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