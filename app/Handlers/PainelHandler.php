<?php

namespace App\Handlers;

use App\Handlers\AbstractHandler;
use App\Helpers\Helper;
use App\Models\Rule;

class PainelHandler extends AbstractHandler
{
    public function afterGetRulesByApplication()
    {
        $rules = & $this->data;
    }
}
