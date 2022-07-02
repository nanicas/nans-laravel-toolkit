<?php

namespace App\Handlers;

class AbstractHandler
{
    protected $data;

    public function setData(array &$data)
    {
        $this->data = & $data;
    }

    public function run(string $method = '')
    {
        $this->{$method}();
    }
}