<?php

namespace Zevitagem\LaravelToolkit\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
use Zevitagem\LaravelToolkit\Traits\Configurable;
use Zevitagem\LaravelToolkit\Helpers\Helper;
use Illuminate\Routing\Controller as BaseController;
use Zevitagem\LaravelToolkit\Traits\AvailabilityWithService;
use Zevitagem\LaravelToolkit\Staters\AppStater;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Configurable, AvailabilityWithService;
    
    public function __construct()
    {
        $this->mergeConfig([
            'assets' => [
                'css' => [],
                'js' => []
            ]
        ]);

        if (!$this->existsConfigIndex('packaged')) {
            $this->configureIndex('packaged', true);
        }
        
        AppStater::setItem('packaged', $this->getConfigIndex('packaged'));
    }

    public function beforeView()
    {
        View::share('assets', $this->getConfig()['assets'] ?? []);
        View::share('view_prefix', Helper::getViewPrefix());
        View::share('assets_prefix', $this->getRootFolderNameOfAssets());
        View::share('packaged_assets_prefix', $this->getRootFolderNameOfAssetsPackaged());
        View::share('screen', $this->getScreen());
    }

    public function getScreen(): string
    {
        list($main) = explode('.', \Request::route()->getName());
        return $main;
    }
    
    public function getSectionScreen(): string
    {
        list(, $main) = explode('.', \Request::route()->getName());
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
    
    public function isPackagedView()
    {
        return ($this->getConfigIndex('packaged') === true);
    }
    
    public function getRootFolderNameOfAssetsPackaged()
    {
        return Helper::getRootFolderNameOfAssets();
    }
    
    public function getRootFolderNameOfAssets()
    {
        $root = Helper::getRootFolderNameOfAssets();
        $packaged = $this->isPackagedView();
        
        return ($packaged) ? $root . '/' : '';
    }
    
    public function addIndexAssets()
    {
        $path = $this->definePathAssets();
        $root = $this->getRootFolderNameOfAssets();

        $this->config['assets']['js'][] = $root . 'resources/pages/' . $path . '/index.js';
        $this->config['assets']['css'][] = $root . 'resources/pages/' . $path . '/index.css';
    }

    public function addShowAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }
        
        $path = $this->definePathAssets();
        $root = $this->getRootFolderNameOfAssets();

        $this->config['assets']['js'][] = $root . 'resources/pages/' . $path . '/show.js';
        $this->config['assets']['css'][] = $root . 'resources/pages/' . $path . '/show.css';
    }

    public function addCreateAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }
        
        $path = $this->definePathAssets();
        $root = $this->getRootFolderNameOfAssets();

        $this->config['assets']['js'][] = $root . 'resources/pages/' . $path . '/create.js';
        $this->config['assets']['css'][] = $root . 'resources/pages/' . $path . '/create.css';
    }

    public function addListAssets()
    {
        $path = $this->definePathAssets();
        $root = $this->getRootFolderNameOfAssets();
        
        $this->config['assets']['js'][] = $root . 'resources/pages/' . $path . '/list.js';
        $this->config['assets']['css'][] = $root . 'resources/pages/' . $path . '/list.css';
    }
}
