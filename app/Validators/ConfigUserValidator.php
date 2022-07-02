<?php

namespace App\Validators;

use App\Validators\AbstractValidator;

class ConfigUserValidator extends AbstractValidator
{
    protected $messages = [
        'name_empty' => 'O apelido não foi preenchido'
    ];

    public function store()
    {
        $this->form();
    }

    public function form()
    {
        $data = $this->getData();

        if (empty($data['name'])) {
            $this->addError('name_empty');
        }
    }

    public function update()
    {
        $this->form();
    }
}