<?php

namespace App\Services\Site;

use App\Services\AbstractService;
use App\Services\Site\ConfigSiteService;
use App\Services\Site\DataSiteService;

class SiteService extends AbstractService
{

    public function __construct(
        ConfigSiteService $configSiteService,
        DataSiteService $dataSiteService
    )
    {
        $this->setDependencie('config_site_service', $configSiteService);
        $this->setDependencie('data_site_service', $dataSiteService);
    }

    public function getIndexData(string $slug)
    {
        $config = $this->getDependencie('config_site_service')->getIndexConfigData($slug);
        $entities = $this->getDependencie('data_site_service')->getIndexData($config);

        return compact('config', 'entities');
    }

}
