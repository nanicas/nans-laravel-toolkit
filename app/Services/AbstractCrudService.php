<?php

namespace Zevitagem\LaravelSaasTemplateCore\Services;

use Zevitagem\LaravelSaasTemplateCore\Services\AbstractService;
use Zevitagem\LegoAuth\Helpers\Helper;

class AbstractCrudService extends AbstractService
{
    public function getIndexData()
    {
        $rows = $this->getRepository()->getAllBySlug(Helper::getSlug());

        return compact('rows');
    }
    
    public function getByIdAndSlug(int $id, int $slug = 0)
    {
        if (empty($slug)) {
            $slug = Helper::getSlug();
        }

        return $this->getRepository()->getByIdAndSlug($id, $slug);
    }
    
    public function getBySlug(int $slug = 0)
    {
        if (empty($slug)) {
            $slug = Helper::getSlug();
        }

        return $this->getRepository()->getBySlug($slug);
    }
}