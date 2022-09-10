<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories\Config;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractCrudRepository;
use Zevitagem\LaravelSaasTemplateCore\Models\Config\DataAddressConfig;

class AddressConfigRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new DataAddressConfig());
    }
    
    public function getByIdAndSlug(int $id, int $slug)
    {
        $row = $this->getModel()->where([
            'id' => $id,
            'slug_config_id' => $slug
        ]);

        return ($row->count() > 0) ? $row->first() : null;
    }
}
