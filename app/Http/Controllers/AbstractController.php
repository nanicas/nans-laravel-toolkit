<?php

namespace Zevitagem\LaravelSaasTemplateCore\Http\Controllers;

use Illuminate\Support\Facades\View;
use Zevitagem\LaravelSaasTemplateCore\Http\Controllers\Controller;
use Zevitagem\LaravelSaasTemplateCore\Traits\Configurable;
use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;

abstract class AbstractController extends Controller
{
    use Configurable;

    public function __construct()
    {
        $this->configure([
            'assets' => [
                'css' => [],
                'js' => []
            ]
        ]);
    }

    public function beforeView()
    {
        View::share('assets', $this->getConfig()['assets']);
        View::share('view_prefix', Helper::getViewPrefix());
        View::share('assets_prefix', Helper::getRootFolderNameOfAssets());
        View::share('screen', $this->getScreen());
    }

    public function getScreen(): string
    {
        list($main) = explode('.', \Request::route()->getName());
        return $main;
    }

    public function addJsAssets(string $path)
    {
        $this->config['assets']['js'][] = $path;
    }

    public function addCssAssets(string $path)
    {
        $this->config['assets']['css'][] = $path;
    }
    
    public function definePathAssets()
    {
        return (method_exists($this, 'getAssetsPath')) ? $this->getAssetsPath() : $this->getScreen();
    }

    public function getControllerName()
    {
        $list = explode('\\', get_class($this));
        end($list);

        return strtolower(str_replace('Controller', '', current($list)));
    }

    public function addIndexAssets()
    {
        $path = $this->definePathAssets();
        $root = Helper::getRootFolderNameOfAssets();
        
        $this->config['assets']['js'][] = $root . '/resources/pages/' . $path . '/index.js';
        $this->config['assets']['css'][] = $root . '/resources/pages/' . $path . '/index.css';
    }

    public function addShowAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }
        
        $path = $this->definePathAssets();
        $root = Helper::getRootFolderNameOfAssets();

        $this->config['assets']['js'][] = $root . '/resources/pages/' . $path . '/show.js';
        $this->config['assets']['css'][] = $root . '/resources/pages/' . $path . '/show.css';
    }

    public function addCreateAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }
        
        $path = $this->definePathAssets();
        $root = Helper::getRootFolderNameOfAssets();

        $this->config['assets']['js'][] = $root . '/resources/pages/' . $path . '/create.js';
        $this->config['assets']['css'][] = $root . '/resources/pages/' . $path . '/create.css';
    }

    public function addListAssets()
    {
        $path = $this->definePathAssets();
        $root = Helper::getRootFolderNameOfAssets();
        
        $this->config['assets']['js'][] = $root . '/resources/pages/' . $path . '/list.js';
        $this->config['assets']['css'][] = $root . '/resources/pages/' . $path . '/list.css';
    }
}
