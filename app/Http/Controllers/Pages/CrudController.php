<?php

namespace Zevitagem\LaravelToolkit\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Zevitagem\LaravelToolkit\Helpers\Helper;
use Throwable;
use Zevitagem\LaravelToolkit\Exceptions\ValidatorException;
use Zevitagem\LaravelToolkit\Exceptions\CustomValidatorException;

class_alias(Helper::readTemplateConfig()['helpers']['global'], __NAMESPACE__ . '\HelperAlias');
class_alias(Helper::readTemplateConfig()['controllers']['dashboard'], __NAMESPACE__ . '\DashboardControllerAlias');

abstract class CrudController extends DashboardControllerAlias
{
    const INDEX_VIEW = 'index';
    const LIST_VIEW = 'list';
    const SHOW_VIEW = 'show';
    const CREATE_VIEW = 'create';

    protected $view;
    protected $request;
    protected bool $indexIsList = true;

    public function setView(string $view)
    {
        $this->view = $view;
    }

    public function getView()
    {
        return $this->view;
    }

    public function indexIsList()
    {
        return $this->indexIsList;
    }

    public function print(array $response)
    {
        echo json_encode($response);
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

        return HelperAlias::view("pages.$screen.$view", $data, $packaged)->render();
    }

    public function beforeView(Request $request)
    {
        View::share('state', $request->query('state'));

        parent::beforeView($request);
    }

    protected function view(array $data = [])
    {
        $view = $this->getView();
        $screen = $this->getScreen();
        $methodConfig = 'config' . ucfirst($view);
        $config = (method_exists($this, $methodConfig)) ? $this->{$methodConfig}() : [];

        $data['config'] = $config;

        $this->beforeView($this->request);

        return $this->createView($screen, $view, $data);
    }

    public function store(Request $request)
    {
        $this->request = $request;
        $this->getService()->configureIndex('request', $request);
        
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $data = $_POST;
        $status = false;
        $id = null;
        $method = __FUNCTION__;
        $resource = null;

        try {
            $this->getService()->handle($data, $method);
            $this->getService()->validate($data, $method);

            $resource = $this->getService()->store($data);
            $status = (is_object($resource));
            $id = ($status) ? $resource->getId() : null;
            $message = 'As informações foram salvas com sucesso';
        } catch (ValidatorException | CustomValidatorException $ex) {
            $message = $ex->getMessage();
        } catch (Throwable $ex) {
            $message = HelperAlias::loadMessage($ex->getMessage(), false);
        }

        $existsDifferentResponseOnEnd = ($this->existsConfigIndex('response_on_end'));
        $canResponseOnEnd = (!$existsDifferentResponseOnEnd || $this->isValidConfig('response_on_end'));

        $redirUrl = (method_exists($this, 'getRedirUrl')) 
                ? $this->getRedirUrl($status, $method, [], $data) 
                : (($status) ? route($this->getScreen() . '.index', ['state' => 'success_store']) : '');

        $response = HelperAlias::createDefaultJsonToResponse($status,
            [
                'status' => $status,
                'message' => $message,
                'resource' => $resource,
                'id' => $id,
                'url_redir' => $redirUrl
            ]
        );

        if ($canResponseOnEnd) {
            return $this->print($response, $status);
        }

        return $response;
    }

    public function update(Request $request)
    {
        $this->request = $request;
        $this->getService()->configureIndex('request', $request);
        
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $data = $_POST;
        $status = false;
        $resource = null;

        try {
            $this->getService()->handle($data, __FUNCTION__);
            $this->getService()->validate($data, __FUNCTION__);

            $status = $this->getService()->update($data, $resource);
            if ($status == false) {
                $message = 'Ocorreu um problema no momento de realizar a atualização!';
            } else {
                $message = 'As informações foram salvas com sucesso!';
            }
            
            $message = HelperAlias::loadMessage($message, $status);
        } catch (ValidatorException | CustomValidatorException $ex) {
            $message = $ex->getMessage();
        } catch (Throwable $ex) {
            $message = HelperAlias::loadMessage($ex->getMessage(), $status);
        }

        $existsDifferentResponseOnEnd = ($this->existsConfigIndex('response_on_end'));
        $canResponseOnEnd = (!$existsDifferentResponseOnEnd || $this->isValidConfig('response_on_end'));

        $response = HelperAlias::createDefaultJsonToResponse($status, [
            'status' => $status,
            'resource' => $resource,
            'message' => $message,
            'url_redir' => ($status) ? route($this->getScreen() . '.index', ['state' => 'success_update']) : ''
        ]);

        if ($canResponseOnEnd) {
            return $this->print($response, $status);
        }

        return $response;
    }

    public function destroy(Request $request, int $id)
    {
        $this->request = $request;
        $this->getService()->configureIndex('request', $request);
        
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $status = false;

        try {
            $result = $this->getService()->destroy($id);
            $status = $result['status'];

            if ($status == false) {
                $message = 'Ocorreu um problema no momento de realizar a exclusão!';
            } else {
                $message = 'Os dados foram excluídos com sucesso!';
            }
            
            $message = HelperAlias::loadMessage($message, $status);
        } catch (ValidatorException | CustomValidatorException $ex) {
            $message = $ex->getMessage();
        } catch (Throwable $ex) {
            $message = HelperAlias::loadMessage($ex->getMessage() . $ex->getFile(), $status);
        }

        echo json_encode(HelperAlias::createDefaultJsonToResponse($status, [
            'id' => $id,
            'status' => $status,
            'message' => $message,
        ]));
    }

    public function index(Request $request)
    {
        return $this->list($request);
    }

    public function list(Request $request)
    {
        $this->request = $request;
        $this->getService()->configureIndex('request', $request);
        
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $this->addListAssets();
        $this->setView(self::LIST_VIEW);

        $data = $this->getService()->getIndexData();

        return self::view($data);
    }

    public function show(Request $request, int $id)
    {
        $this->request = $request;
        $this->getService()->configureIndex('request', $request);
        
        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $data = [];
        $status = false;

        $this->addShowAssets();
        $this->setView(self::SHOW_VIEW);

        try {
            $data = $this->getService()->getDataToShow($id);
            $status = true;
            $message = HelperAlias::loadMessage('Dados encontrados com sucesso, segue abaixo a relação das informações.', $status);
        } catch (ValidatorException | CustomValidatorException $ex) {
            $message = $ex->getMessage();
        } catch (Throwable $ex) {
            $message = HelperAlias::loadMessage($ex->getMessage(), $status);
        }

        return self::view(compact('data', 'message', 'status'));
    }

    public function configlist()
    {
        return [
            'create_option' => true
        ];
    }

    public function create(Request $request)
    {
        $this->request = $request;
        $this->getService()->configureIndex('request', $request);

        if (!$this->isAllowed()) {
            return $this->notAllowedResponse($request);
        }

        $this->addCreateAssets();
        $this->setView(self::CREATE_VIEW);
        $message = '';
        $data = [];
        $status = false;

        try {
            $data = $this->getService()->getDataToCreate();
            $status = true;
        } catch (ValidatorException | CustomValidatorException $ex) {
            $message = $ex->getMessage();
        } catch (Throwable $ex) {
            $message = HelperAlias::loadMessage($ex->getMessage(), $status);
        }

        return self::view(compact('data', 'message', 'status'));
    }

}
