<?php

namespace App\Repositories\Config;

use App\Repositories\AbstractCrudRepository;
use App\Models\Config\DataConfig;

class DataConfigRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new DataConfig());
    }
}
