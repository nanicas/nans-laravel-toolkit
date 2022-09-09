<?php

namespace App\Services;

use App\Services\AbstractService;
use Zevitagem\LegoAuth\Services\ApplicationService;
use Zevitagem\LegoAuth\Filters\ApplicationRemoverItself;

class HomeService extends AbstractService
{
    public function getIndexData()
    {
        $service      = new ApplicationService(new ApplicationRemoverItself());
        $applications = $service->getApplicationsToShareSession();

        return compact('applications');
    }
}