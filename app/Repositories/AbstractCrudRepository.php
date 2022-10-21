<?php

namespace Zevitagem\LaravelSaasTemplateCore\Repositories;

use Zevitagem\LaravelSaasTemplateCore\Repositories\DatabaseRepository;
use Zevitagem\LaravelSaasTemplateCore\Exceptions\CrudException;
use Zevitagem\LaravelSaasTemplateCore\Models\AbstractModel;

abstract class AbstractCrudRepository extends DatabaseRepository
{
    public function newException($exc)
    {
        throw new CrudException($exc->getMessage());
    }

    public function getDeletedAtColumn()
    {
        return $this->model::COLUMN_DELETED_AT;
    }

    public function store(array $data)
    {
        return $this->getModel()->create($data);
    }
    
    public function deleteByCondition(array $condition)
    {
        return $this->getModel()->where($condition)->delete();
    }
    
    public function insert(array $data)
    {
        return $this->getModel()->insert($data);
    }

    public function update(AbstractModel $model)
    {
        return $model->save();
    }
    
    public function getAllBySlug(int $slug)
    {
        $rows = $this->getModel()->where([
            'slug' => $slug
        ]);

        return $rows->get();
    }
    
    public function getBySlug(int $slug)
    {
        $row = $this->getModel()->where([
            'slug' => $slug
        ]);

        return ($row->count() > 0) ? $row->first() : null;
    }
    
    public function getAllActive()
    {
        return $this->getModel()->where([
            'active' => 1
        ])->get();
    }
    
    public function getAll()
    {
        return $this->getModel()->get();
    }

    public function getByIdAndSlug(int $id, int $slug)
    {
        $row = $this->getModel()->where([
            'id' => $id,
            'slug' => $slug
        ]);

        return ($row->count() > 0) ? $row->first() : null;
    }

    public function getById(int $id)
    {
        return $this->getModel()->find($id);
    }
}