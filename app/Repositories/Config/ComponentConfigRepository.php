<?php

namespace App\Repositories\Config;

use App\Repositories\AbstractCrudRepository;
use App\Models\Config\ComponentConfig;

class ComponentConfigRepository extends AbstractCrudRepository
{

    public function __construct()
    {
        parent::setModel(new ComponentConfig());
    }

}
