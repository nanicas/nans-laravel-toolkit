<?php

namespace Zevitagem\LaravelToolkit\Services;

use Zevitagem\LaravelToolkit\Services\AbstractService;
use Zevitagem\LaravelToolkit\Helpers\Helper;

class AbstractCrudService extends AbstractService
{
    public function getIndexData(array $data = [])
    {
        $rows = $this->getRepository()->getAll();

        return compact('rows');
    }

    public function getDataToCreate()
    {
        return $this->getDataToForm();
    }
    
    public function getDataToForm()
    {
        return [];
    }
    
    public function getByIdAndSlug(int $id, int $slug = 0)
    {
        if (empty($slug)) {
            $slug = Helper::getSlug();
        }

        return $this->getRepository()->getByIdAndSlug($id, $slug);
    }
    
    public function getById(int $id)
    {
        return $this->getRepository()->getById($id);
    }
    
    public function getBySlug(int $slug = 0)
    {
        if (empty($slug)) {
            $slug = Helper::getSlug();
        }

        return $this->getRepository()->getBySlug($slug);
    }
    
    public function getAllActive()
    {
        return $this->getRepository()->getAllActive();
    }
    
    public function getAll()
    {
        return $this->getRepository()->getAll();
    }
    
    public function destroy(int $id)
    {
        $loggedUser = Helper::getUser();
        
        $data = compact('id');
        $data['row'] = $this->getRepository()->getById($id);
        $data['logged_user'] = $loggedUser;
        
        if (method_exists($this, 'complementDataOnDestroy')) {
            $this->complementDataOnDestroy($data);
        }
        
        parent::handle($data, 'destroy');
        parent::validate($data, 'destroy');
        parent::validate($data, 'beforeDestroyPersistence');
        
        $status = $this->getRepository()->delete($data['row']);
        
        return [
            'status' => $status,
            'row' => $data['row']
        ];
    }
    
    public function getDataToShow(int $id)
    {
        $loggedUser = Helper::getUser();
        
        $data = compact('id');
        $data['row'] = $this->getRepository()->getById($id);
        $data['logged_user'] = $loggedUser;
        
        if (method_exists($this, 'complementDataOnShow')) {
            $this->complementDataOnShow($data);
        }
        
        parent::handle($data, 'show');
        parent::validate($data, 'show');
     
        $dataForm = $this->getDataToForm();

        return array_merge($data, $dataForm);
    }
}