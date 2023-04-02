<?php

namespace Zevitagem\LaravelToolkit\Repositories;

use Zevitagem\LaravelToolkit\Repositories\DatabaseRepository;
use Zevitagem\LaravelToolkit\Exceptions\CrudException;
use Zevitagem\LaravelToolkit\Models\AbstractModel;

abstract class AbstractCrudRepository extends DatabaseRepository
{
    const PAGINATE_MAX_ROWS = 15;
    
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
    
    public function updateOrCreate(array $condition, array $data)
    {
        return $this->getModel()->updateOrCreate($condition, $data);
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
    
    public function delete(AbstractModel $model)
    {
        return $model->delete();
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
    
    public function destroy(int $id)
    {
        return $this->getModel()->destroy($id);
    }

    public function getById(int $id)
    {
        return $this->getModel()->find($id);
    }
}