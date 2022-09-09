<?php

namespace App\Handlers;

use App\Handlers\AbstractHandler;
use App\Helpers\Helper;

class HistoricHandler extends AbstractHandler
{
    public function form(&$data)
    {
        $data['description'] = trim($data['description']);
        $data['happened_at'] = trim($data['happened_at']);
        $data['observation'] = trim($data['observation']);

        if (empty($data['happened_at'])) {
            $data['happened_at'] = null;
        }
        if (empty($data['observation'])) {
            $data['observation'] = null;
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
