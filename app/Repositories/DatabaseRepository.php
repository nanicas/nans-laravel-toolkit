<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractRepository;

abstract class DatabaseRepository extends AbstractRepository
{
    public function getTable()
    {
        return $this->getModel()->getTable();
    }

    public function newException($exc)
    {
        throw $exc;
    }
}
