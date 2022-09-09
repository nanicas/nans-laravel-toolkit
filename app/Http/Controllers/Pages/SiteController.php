<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\SiteController as SiteBase;
use App\Services\Site\SiteService;
use Illuminate\Http\Request;

class SiteController extends SiteBase
{
    public function __construct(SiteService $service)
    {
        $this->setService($service);

        parent::__construct();
    }

    public function index(Request $request, string $slug = '')
    {
        $theme = $request->query('theme') ?? 'zacson';

        $data = $this->getService()->getIndexData($slug);
        $view = ($data['config']['page'] == 'contracted') ? 'pages.site.themes.' . $theme : 'pages.site.' . $data['config']['page'];

        $this->addIndexAssets();
        $this->beforeView();

        return view($view, $data);
    }
}
