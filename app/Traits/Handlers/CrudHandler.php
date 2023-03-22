<?php

namespace Zevitagem\LaravelToolkit\Traits\Handlers;

use Zevitagem\LaravelToolkit\Helpers\Helper;

trait CrudHandler
{
    public function destroy()
    {
        $data = & $this->data;

        $config = Helper::readTemplateConfig();

        $data['row'] = (isset($data['row'])) ? $data['row'] : null;

        if (!empty($config['has_slug'])) {
            $data['slug'] = Helper::getSlug();
        } else {
            $data['logged_user'] = Helper::getUser();
        }
    }
}
