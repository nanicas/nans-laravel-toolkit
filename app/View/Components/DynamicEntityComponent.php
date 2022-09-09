<?php

namespace Zevitagem\LaravelSaasTemplateCore\View\Components;

use Illuminate\View\Component;

class DynamicEntityComponent extends Component
{
    public $entity_data;
    public $entity_info;

    public function __construct(?string $construct)
    {
        if (empty($construct)) {
            return;
        }

        $info = json_decode(base64_decode($construct), true);
        if (!is_array($info)) {
            return;
        }

        $data = $info['data'];
        unset($info['data']);

        if (!empty($data['extra'])) {
            $data['extra'] = json_decode($data['extra'], true);
        }

        $this->entity_info = $info;
        $this->entity_data = $data;
    }

    public function render()
    {
        return function (array $data) {

            if (!empty($data['entity_info']['component_template'])) {
                return $data['entity_info']['component_template'];
            }

            return 'components.site.themes.default.simple';
        };
    }
}
