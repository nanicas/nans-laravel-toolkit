<?php

namespace Zevitagem\LaravelToolkit\Traits\Validators;

use Zevitagem\LaravelToolkit\Models\AbstractModel;

trait CrudValidator
{
    public function store()
    {
        $this->form();
    }

    public function update()
    {
        $this->form();
    }

    public function destroy()
    {
        $data = $this->getData();

        if (!is_int($data['id']) || $data['id'] <= 0) {
            $this->addError('id_invalid');
        }
    }

    public function show()
    {
        $this->validateRow();
        $this->validateOwnership();
    }

    public function beforeStorePersistence()
    {
        $this->beforePersist();

        if ($this->hasErrors()) {
            return;
        }

        $this->validateOwnership();
    }

    public function beforeDestroyPersistence()
    {
        $this->validateRow();
        if ($this->hasErrors()) {
            return;
        }

        $this->validateOwnership();
    }

    public function beforeUpdatePersistence()
    {
        $this->validateRow();
        $this->beforePersist();

        if ($this->hasErrors()) {
            return;
        }

        $this->validateOwnership();
    }

    protected function validateOwnership()
    {
        $belongs = true;
        if (defined(static::class . '::BELONGS_TO_LOGGED_USER')) {
            $belongs = static::BELONGS_TO_LOGGED_USER;
        }

        if (!$belongs) {
            return;
        }

        $data = $this->getData();
        
        $this->validateOwnershipByAttributes($data);
    }
    
    protected function validateOwnershipByAttributes(array $data) 
    {
        if (isset($data['row'])) { //is update
            $this->validateOwnershipCaseUpdate($data);
        }
        if (isset($data['user_id'])) { //is store
            $this->validateOwnershipCaseStore($data);
        }
    }

    protected function validateOwnershipCaseUpdate(array $data)
    {
        if ($data['row']->getUserId() != $data['logged_user']->getId()) {
            $this->addError('only_owner_can_manipulate');
        }
    }
    
    protected function validateOwnershipCaseStore(array $data)
    {
        if ($data['user_id'] != $data['logged_user']->getId()) {
            $this->addError('only_owner_can_manipulate');
        }
    }
    
    protected function validateRow()
    {
        $data = $this->getData();
        if (!($data['row'] instanceof AbstractModel)) {
            $this->addError('row_not_found');
        }
    }

    public function beforePersist()
    {
        //
    }
}
