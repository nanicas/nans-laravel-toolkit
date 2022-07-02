<?php

namespace App\Services;

use App\Services\AbstractService;
use Zevitagem\LegoAuth\Helpers\Helper;

class AbstractCrudService extends AbstractService
{
    public function getByIdAndSlug(int $id, int $slug = 0)
    {
        if (empty($slug)) {
            $slug = Helper::getSlug();
        }

        return $this->getRepository()->getByIdAndSlug($id, $slug);
    }
}