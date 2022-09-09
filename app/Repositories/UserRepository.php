<?php

namespace App\Repositories;

use App\Repositories\AbstractCrudRepository;
use App\Models\User;

class UserRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new User());
    }
}
