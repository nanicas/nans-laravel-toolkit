<?php

namespace Zevitagem\LaravelSaasTemplateCore\Handlers\Config;

use Zevitagem\LaravelSaasTemplateCore\Handlers\AbstractHandler;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;
use Zevitagem\LaravelSaasTemplateCore\Traits\Handlers\CrudHandler;

class CategoryConfigHandler extends AbstractHandler
{
    use CrudHandler;
    
    public function form(&$data)
    {
        $data['name'] = trim($data['name']);
        $data['key'] = trim($data['key']);
        $data['active'] = (int) (isset($data['active']) ? boolval($data['active']) : false);

        if (empty($data['key'])) {
            $data['key'] = Helper::generateCleanSnakeText($data['name']);
        }
    }

    public function store()
    {
        $data = & $this->data;
        $data['slug'] = Helper::getSlug();

        $this->form($data);
    }

    public function update()
    {
        $data = & $this->data;

        $this->form($data);
    }
}
