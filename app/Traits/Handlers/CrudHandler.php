<?php

namespace App\Traits\Handlers;

use App\Helpers\Helper;

trait CrudHandler
{
    public function destroy()
    {
        $data = & $this->data;

        $data['row'] = (isset($data['row'])) ? $data['row'] : null;
        $data['logged_user'] = Helper::getUser();
    }
}
