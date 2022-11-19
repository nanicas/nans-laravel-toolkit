<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;

class_alias(Helper::readTemplateConfig()['controllers']['crud'], __NAMESPACE__ . '\CrudControllerAlias');

abstract class BaseConfigController extends CrudControllerAlias
{
    use IsConfigurationPageSection;

    public function getTabOptions()
    {
        if (Helper::isAdmin()) {
            return [
                'user_config' => 'Usuário',
                'data_config' => 'Dados',
                'category_config' => 'Categoria',
                'component_config' => 'Componente',
                'entity_config' => 'Entidade',
            ];
        }

        return ['user_config' => 'Usuário'];
    }
}
