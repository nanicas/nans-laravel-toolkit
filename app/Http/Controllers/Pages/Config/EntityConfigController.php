<?php

namespace App\Http\Controllers\Pages\Config;

use App\Services\Config\EntityConfigService;
use App\Http\Controllers\Pages\CrudController;
use App\Traits\IsConfigurationPageSection;
use Illuminate\Http\Request;

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

        return view('pages.config.entity_config.form-by-component', compact('data', 'message'));
    }

}
