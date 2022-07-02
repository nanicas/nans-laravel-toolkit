<?php

namespace App\Traits;

use App\Services\AbstractService;

trait AvailabilityWithService
{
    private $service;

    public function setService(AbstractService $service)
    {
        $this->service = $service;
    }

    public function getService()
    {
        return $this->service;
    }
}