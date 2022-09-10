<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\Config;

use Zevitagem\LaravelSaasTemplateCore\Services\Config\EntityConfigService;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages\CrudController;
use Zevitagem\LaravelSaasTemplateCore\Traits\IsConfigurationPageSection;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

class EntityConfigController extends CrudController
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

        return Helper::view('pages.config.entity_config.form-by-component', compact('data', 'message'));
    }

}
