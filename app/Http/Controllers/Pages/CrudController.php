<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;
use Exception;

class_alias(Helper::readTemplateConfig()['controllers']['dashboard'],  __NAMESPACE__ . '\DashboardControllerAlias');

abstract class CrudController extends DashboardControllerAlias
{   
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
        $root = $this->getRootFolderNameOfAssets();
        $packagedRoot = $this->getRootFolderNameOfAssetsPackaged();

        $this->config['assets']['js'][] = $packagedRoot . '/resources/layouts/crud/form.js';
        $this->config['assets']['css'][] = $packagedRoot . '/resources/layouts/crud/form.css';
        $this->config['assets']['js'][] = $root . 'resources/pages/' . $path . '/form.js';
        $this->config['assets']['css'][] = $root . 'resources/pages/' . $path . '/form.css';
    }

    public function addListAssets()
    {
        $packagedRoot = $this->getRootFolderNameOfAssetsPackaged();
        
        parent::addJsAssets($packagedRoot . '/resources/layouts/crud/list.js');
        parent::addListAssets();
    }

    protected function createView(string $screen, string $view, array $data)
    {
        $packaged = $this->isPackagedView();

        return Helper::view("pages.$screen.$view", $data, $packaged)->render();
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
            $this->getService()->handle($data, __FUNCTION__);
            $this->getService()->validate($data, __FUNCTION__);

            $row = $this->getService()->store($data);
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
            $this->getService()->handle($data, __FUNCTION__);
            $this->getService()->validate($data, __FUNCTION__);

            $status = $this->getService()->update($data);
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
            $this->getService()->validate($data, __FUNCTION__);
            $status = $this->getService()->destroy($data['id']);

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
            $data = $this->getService()->getDataToShow($id);
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

        $data = $this->getService()->getIndexData();

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
            $data = $this->getService()->getDataToCreate();
            $status = true;
        } catch (Exception $ex) {
            $data = [];
            $message = $ex->getMessage();
            $status = false;
        }

        return self::view(compact('data', 'message', 'status'));
    }
}
