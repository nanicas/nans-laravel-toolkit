<?php

namespace App\Repositories\Config;

use App\Repositories\AbstractCrudRepository;
use App\Models\Config\CategoryConfig;

class CategoryConfigRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new CategoryConfig());
    }
}
