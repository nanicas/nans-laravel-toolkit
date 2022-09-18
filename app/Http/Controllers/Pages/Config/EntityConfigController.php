<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\Config\EntityConfigService;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class_alias(Helper::readTemplateConfig()['controllers']['base_config'],  __NAMESPACE__ . '\BaseConfigControllerAlias');

class EntityConfigController extends BaseConfigControllerAlias
{
    use IsConfigurationPageSection;

    public function __construct(EntityConfigService $service)
    {
        parent::__construct();

        $this->setService($service);
        $this->onConstructSection();
    }
    
    public function dynamicFormByComponent(Request $request)
    {
        $id = $request->get('id');
        $componentId = $request->get('component_id');

        try {
            $data    = $this->getService()->getDataToDynamicForm($componentId, $id);
            $message = '';
        } catch (\Exception $ex) {
            $data    = [];
            $message = $ex->getMessage();
        }

        return $this->createView('', 'entity_config.form-by-component', compact('data', 'message'));
    }
}
