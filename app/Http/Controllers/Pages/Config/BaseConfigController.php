<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class_alias(Helper::readTemplateConfig()['controllers']['crud'],  __NAMESPACE__ . '\CrudControllerAlias');

abstract class BaseConfigController extends CrudControllerAlias
{   
    
}
