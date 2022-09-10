<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractCrudRepository;
use Zevitagem\LaravelSaasTemplateCore\Models\User;

class UserRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new User());
    }
}
