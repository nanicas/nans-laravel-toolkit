<?php

namespace Zevitagem\LaravelSaasTemplateCore\Validators;

use Zevitagem\LaravelSaasTemplateCore\Validators\AbstractValidator;

class HistoricValidator extends AbstractValidator
{
    protected $messages = [
        'description_empty' => 'Pelo menos uma descrição deve ser preenchida',
    ];

    public function store()
    {
        $this->form();
    }

    public function form()
    {
        $data = $this->getData();

        if (empty($data['description'])) {
            $this->addError('description_empty');
        }
    }

    public function update()
    {
        $this->form();
    }
}
