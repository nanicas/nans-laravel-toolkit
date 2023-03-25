<?php

namespace Zevitagem\LaravelToolkit\Traits\Handlers;

trait CrudHandler
{
    public function destroy()
    {
        $data = & $this->data;

        $data['row'] = (isset($data['row'])) ? $data['row'] : null;
    }
}
