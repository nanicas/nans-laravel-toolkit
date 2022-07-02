<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\SiteController as SiteBase;
use App\Services\SiteService;

class SiteController extends SiteBase
{
    public function __construct(SiteService $service)
    {
        $this->setService($service);

        parent::__construct();
    }

    public function index(string $slug = '')
    {
        $data = $this->getService()->getIndexData($slug);
        $view = ($data['page'] == 'contracted') ? 'pages.site.themes.burguer' : 'pages.site.'.$data['page'];

        $this->addIndexAssets();
        $this->beforeView();

        return view($view, compact('data'));
    }
}