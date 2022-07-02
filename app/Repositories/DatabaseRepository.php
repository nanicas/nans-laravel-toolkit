<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;

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