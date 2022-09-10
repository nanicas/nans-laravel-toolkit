<?php

namespace Zevitagem\LaravelSaasTemplateCore\Handlers;

use Zevitagem\LaravelSaasTemplateCore\Handlers\AbstractHandler;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class ConfigUserHandler extends AbstractHandler
{
    public function form(&$data)
    {
        $data['name']  = trim($data['name']);
        $data['admin'] = (int) (isset($data['admin']) ? boolval($data['admin']) : false);
    }

    public function store()
    {
        $data = & $this->data;

        $this->form($data);

        if (!Helper::isMaster()) {
            $data['admin'] = 0;
        }
    }

    public function update()
    {
        $data = & $this->data;

        $this->form($data);

        if (!Helper::isMaster()) {
            unset($data['admin']);
        }
    }
}