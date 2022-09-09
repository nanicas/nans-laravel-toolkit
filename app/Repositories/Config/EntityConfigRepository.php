<?php

namespace App\Repositories\Config;

use App\Repositories\AbstractCrudRepository;
use App\Models\Config\EntityConfig;

class EntityConfigRepository extends AbstractCrudRepository
{

    public function __construct()
    {
        parent::setModel(new EntityConfig());
    }

}
