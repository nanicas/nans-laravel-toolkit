<?php

namespace Zevitagem\LaravelSaasTemplateCore\Handlers;

use Zevitagem\LaravelSaasTemplateCore\Handlers\AbstractHandler;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;
use Zevitagem\LaravelSaasTemplateCore\Models\Rule;

class PainelHandler extends AbstractHandler
{
    public function afterGetRulesByApplication()
    {
        $rules = & $this->data;
    }
}
