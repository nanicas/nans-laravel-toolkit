<?php

namespace Zevitagem\LaravelSaasTemplateCore\Traits;

//use Zevitagem\LaravelSaasTemplateCore\Services\AbstractService;

trait AvailabilityWithService
{
    private $service;

    //public function setService(AbstractService $service)
    public function setService($service)
    {
        $this->service = $service;
    }

    public function getService()
    {
        return $this->service;
    }
}
