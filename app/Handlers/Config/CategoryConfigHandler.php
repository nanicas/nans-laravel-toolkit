<?php

namespace App\Handlers\Config;

use App\Handlers\AbstractHandler;
use App\Helpers\Helper;

class CategoryConfigHandler extends AbstractHandler
{
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
