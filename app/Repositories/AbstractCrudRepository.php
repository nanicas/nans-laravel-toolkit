<?php

namespace App\Repositories;

use App\Repositories\DatabaseRepository;
use App\Exceptions\CrudException;
use App\Models\AbstractModel;

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

    public function getRows()
    {
        return $this->getModel()->all();
    }

    public function store(array $data)
    {
        return $this->getModel()->create($data);
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