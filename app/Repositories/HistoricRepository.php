<?php

namespace App\Repositories;

use App\Repositories\AbstractCrudRepository;
use App\Models\Historic;

class HistoricRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new Historic());
    }
}
