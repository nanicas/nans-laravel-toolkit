<?php

namespace App\Traits\Validators;

use Zevitagem\LaravelSaasTemplateCore\Models\AbstractModel;

trait CrudValidator
{
    public function __construct()
    {
        $this->messages['id_invalid'] = 'O ID é inválido';
        $this->messages['row_not_found'] = 'O registro não foi encontrado';
        $this->messages['only_owner_can_delete_the_row'] = 'Somente o proprietário pode excluir o registro';
    }

    public function destroy()
    {
        $data = $this->getData();

        if (!is_int($data['id']) || $data['id'] <= 0) {
            $this->addError('id_invalid');
        }

        if (!($data['row'] instanceof AbstractModel)) {
            return $this->addError('row_not_found');
        }

        if ($data['row']->getUserId() != $data['logged_user']->getId()) {
            $this->addError('only_owner_can_delete_the_row');
        }
    }
}
