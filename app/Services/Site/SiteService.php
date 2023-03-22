<?php

namespace Zevitagem\LaravelToolkit\Services\Site;

use Zevitagem\LaravelToolkit\Services\AbstractService;
use Zevitagem\LaravelToolkit\Services\Site\ConfigSiteService;
use Zevitagem\LaravelToolkit\Services\Site\DataSiteService;

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

    public function getIndexData(array $data = [])
    {
        $config = $this->getDependencie('config_site_service')->getIndexConfigData($data['slug']);
        $entities = $this->getDependencie('data_site_service')->getIndexData($config);

        return compact('config', 'entities');
    }

}
