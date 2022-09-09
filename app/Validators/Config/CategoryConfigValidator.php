<?php

namespace App\Validators\Config;

use App\Validators\AbstractValidator;

class CategoryConfigValidator extends AbstractValidator
{
    protected $messages = [
        'name_empty' => 'O nome da categoria não foi preenchido',
        'key_empty' => 'A chave da categoria não foi preenchida',
        'slug_empty' => 'O Slug é um campo obrigatório',
    ];

    public function store()
    {
        $this->form();
        
        $data = $this->getData();
        
        if (empty($data['slug'])) {
            $this->addError('slug_empty');
        }
    }

    public function form()
    {
        $data = $this->getData();

        if (empty($data['name'])) {
            $this->addError('name_empty');
        }
        if (empty($data['key'])) {
            $this->addError('key_empty');
        }
    }

    public function update()
    {
        $this->form();
    }
}