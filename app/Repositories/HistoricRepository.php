<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractCrudRepository;
use Zevitagem\LaravelSaasTemplateCore\Models\Historic;

class HistoricRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new Historic());
    }
}
