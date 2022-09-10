<?php

namespace Zevitagem\LaravelSaasTemplateCore\Handlers;

class AbstractHandler
{
    protected $data;

    public function setData(mixed &$data)
    {
        $this->data = & $data;
    }

    public function run(string $method = '')
    {
        if (!method_exists($this, $method)) {
            return;
        }
        
        $this->{$method}();
    }
}