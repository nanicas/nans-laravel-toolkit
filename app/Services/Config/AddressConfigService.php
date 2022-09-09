<?php

namespace App\Services\Config;

use App\Services\AbstractCrudService;
use App\Repositories\Config\AddressConfigRepository;
use App\Validators\Config\AddressConfigValidator;
use App\Handlers\Config\AddressConfigHandler;
use App\Models\Config\DataConfig;

class AddressConfigService extends AbstractCrudService
{
    public function __construct(
        AddressConfigRepository $repository,
        AddressConfigValidator $validator,
        AddressConfigHandler $handler
    )
    {
        parent::setRepository($repository);
        parent::setValidator($validator);
        parent::setHandler($handler);
    }

    public function getDataToCreate()
    {
        return [];
    }

    public function getDataToShow(int $id)
    {
        $row = $this->getByIdAndSlug($id);

        return compact('row');
    }

    public function storeBulk(array $data, DataConfig $dataConfig)
    {
        foreach ($data as &$row) {

            $row['slug_config_id'] = $dataConfig->getSlug();

            parent::handle($row, 'store');
            parent::validate($row, 'store');
        }

        return $this->getRepository()->insert($data);
    }

    public function updateBulk(array $data, DataConfig $dataConfig)
    {
        foreach ($data as &$row) {

            parent::handle($row, 'update');
            parent::validate($row, 'update');
            
            $this->update($row, $dataConfig);
        }
    }

    private function update(array $data, DataConfig $dataConfig)
    {
        $address = $this->getByIdAndSlug($data['id'], $dataConfig->getSlug());

        if (empty($address)) {
            throw new \InvalidArgumentException('Não foi possível encontrar os dados do endereço e contato');
        }

        unset($data['id'], $data['slug_config_id']);

        $address->fill($data);

        return $this->getRepository()->update($address);
    }
}
