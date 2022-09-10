<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories\Config;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractCrudRepository;
use Zevitagem\LaravelSaasTemplateCore\Models\Config\EntityConfig;

class EntityConfigRepository extends AbstractCrudRepository
{

    public function __construct()
    {
        parent::setModel(new EntityConfig());
    }

}
