<?php

namespace Zevitagem\LaravelToolkit\Traits\Validators;

use Zevitagem\LaravelToolkit\Models\AbstractModel;

trait CrudValidator
{
    /**
     * Implement in child classes
     * 
     * public function form();
     */
    
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
        $data = $this->getData();

        if (!($data['row'] instanceof AbstractModel)) {
            return $this->addError('row_not_found');
        }
        
        $this->validateOwnership();
    }

    public function beforeStorePersistence()
    {
        $this->beforePersist();
    }

    public function beforeDestroyPersistence()
    {
        $this->beforeUpdatePersistence();
    }

    public function beforeUpdatePersistence()
    {
        $data = $this->getData();
        if (!($data['row'] instanceof AbstractModel)) {
            $this->addError('row_not_found');
        }

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

        if ($data['row']->getUserId() != $data['logged_user']->getId()) {
            $this->addError('only_owner_can_manipulate');
        }
    }

    public function beforePersist()
    {
        //
    }
}
