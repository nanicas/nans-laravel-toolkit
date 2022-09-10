<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories\Config;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractCrudRepository;
use Zevitagem\LaravelSaasTemplateCore\Models\Config\ComponentConfig;

class ComponentConfigRepository extends AbstractCrudRepository
{

    public function __construct()
    {
        parent::setModel(new ComponentConfig());
    }

}
