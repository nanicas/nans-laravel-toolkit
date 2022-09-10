<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages;

use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Zevitagem\LaravelSaasTemplateCore\Traits\AvailabilityWithService;
use Illuminate\Support\Facades\View;
use Zevitagem\LegoAuth\Helpers\Helper;
use Exception;

abstract class CrudController extends DashboardController
{
    use AvailabilityWithService;
    
    const LIST_VIEW = 'list';
    const SHOW_VIEW = 'show';
    const CREATE_VIEW = 'create';

    private $view;

    public function setView(string $view)
    {
        $this->view = $view;
    }

    public function getView()
    {
        return $this->view;
    }

    public function addFormAssets()
    {
        $path = $this->definePathAssets();

        $this->config['assets']['js'][] = 'resources/layouts/crud/form.js';
        $this->config['assets']['css'][] = 'resources/layouts/crud/form.css';
        $this->config['assets']['js'][] = 'resources/pages/' . $path . '/form.js';
        $this->config['assets']['css'][] = 'resources/pages/' . $path . '/form.css';
    }

    public function addListAssets()
    {
        parent::addJsAssets('resources/layouts/crud/list.js');
        parent::addListAssets();
    }

    protected function createView(string $screen, string $view, array $data)
    {
        return view("pages.$screen.$view", $data)->render();
    }
    
    public function beforeView()
    {
        $request = request();
        
        View::share('state', $request->query('state'));

        parent::beforeView();
    }

    protected function view(array $data = [])
    {
        $view = $this->getView();
        $screen = $this->getScreen();
        $methodConfig = 'config' . ucfirst($view);
        $config = (method_exists($this, $methodConfig)) ? $this->{$methodConfig}() : [];

        $data['config'] = $config;

        $this->beforeView();

        return $this->createView($screen, $view, $data);
    }

    public function store(Request $request)
    {
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $data = $_POST;

        try {
            $this->service->handle($data, __FUNCTION__);
            $this->service->validate($data, __FUNCTION__);

            $row = $this->service->store($data);
            $status = (is_object($row));
            $id = ($status) ? $row->getId() : null;
            $message = '';
        } catch (Exception $exc) {
            $message = $exc->getMessage();
            $status = false;
            $id = null;
        }

        echo json_encode(Helper::createDefaultJsonToResponse($status,
            [
                'status' => $status,
                'message' => ($status) ? 'As informações foram salvas com sucesso' : $message,
                'id' => $id,
                'url_redir' => ($status) ? route($this->getScreen() . '.index', ['state' => 'success_store']) : ''
            ]
        ));
    }

    public function update(Request $request)
    {
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $data = $_POST;

        try {
            $this->service->handle($data, __FUNCTION__);
            $this->service->validate($data, __FUNCTION__);

            $status = $this->service->update($data);
            $message = '';
        } catch (Exception $exc) {
            $message = $exc->getMessage();
            $status = false;
        }

        echo json_encode(Helper::createDefaultJsonToResponse($status, [
                'status' => $status,
                'message' => ($status) ? 'As informações foram salvas com sucesso' : $message,
                'url_redir' => ($status) ? route($this->getScreen() . '.index',
                                ['state' => 'success_update']) : ''
        ]));
    }

    public function destroy(Request $request)
    {
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $data = $_GET;

        try {
            $this->service->validate($data, __FUNCTION__);
            $status = $this->service->destroy($data['id']);

            $message = 'Os dados foram excluídos com sucesso!';
        } catch (Exception $exc) {
            $message = $exc->getMessage();
            $status = false;
        }

        echo json_encode([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function index(Request $request)
    {
        return $this->list($request);
    }

    public function show(Request $request, int $id)
    {
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $this->addShowAssets();
        $this->setView(self::SHOW_VIEW);

        try {
            $data = $this->service->getDataToShow($id);
            $message = 'Dados encontrados com sucesso, segue abaixo a relação das informações.';
            $status = true;
        } catch (Exception $ex) {
            $data = [];
            $message = $ex->getMessage();
            $status = false;
        }

        return self::view(compact('data', 'message', 'status'));
    }

    public function list(Request $request)
    {
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $this->addIndexAssets();
        $this->setView(self::LIST_VIEW);

        $data = $this->service->getIndexData();

        return self::view($data);
    }

    public function configlist()
    {
        return [
            'create_option' => true
        ];
    }

    public function create(Request $request)
    {
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $this->addCreateAssets();
        $this->setView(self::CREATE_VIEW);
        $message = '';

        try {
            $data = $this->service->getDataToCreate();
            $status = true;
        } catch (Exception $ex) {
            $data = [];
            $message = $ex->getMessage();
            $status = false;
        }

        return self::view(compact('data', 'message', 'status'));
    }
}
