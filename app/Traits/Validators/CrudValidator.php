<?php

namespace Zevitagem\LaravelToolkit\Traits\Validators;

use Zevitagem\LaravelToolkit\Models\AbstractModel;

trait CrudValidator
{
    public function __construct()
    {
        $this->messages['id_invalid'] = 'O ID é inválido';
        $this->messages['row_not_found'] = 'O registro não foi encontrado';
        $this->messages['only_owner_can_delete_the_row'] = 'Somente o proprietário pode excluir o registro';
        $this->messages['you_can_only_delete_records_belonging_to_your_scope'] = 'Você só pode excluir registros pertencentes ao seu escopo';
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
    }
}
