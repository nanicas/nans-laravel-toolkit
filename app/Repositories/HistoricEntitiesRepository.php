<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories;

use Zevitagem\LaravelSaasTemplateCore\Repositories\AbstractCrudRepository;
use Zevitagem\LaravelSaasTemplateCore\Models\HistoricEntities;
use Zevitagem\LaravelSaasTemplateCore\Models\Historic;

class HistoricEntitiesRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new HistoricEntities());
    }

    public function attach(Historic $historic, array $data)
    {
        $historicId = $historic->getId();
        $toInsert = [];

        foreach ($data as $entityId => $complement) {

            $toInsert[] = array_merge([
                'historic_id' => $historicId,
                'entity_id' => $entityId
                    ], $complement);
        }

        if (!empty($toInsert)) {
            return parent::insert($toInsert);
        }
    }
}
