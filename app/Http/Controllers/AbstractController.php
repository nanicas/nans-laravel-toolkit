<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Traits\Configurable;

abstract class AbstractController extends Controller
{
    use Configurable;

    public function __construct()
    {
        //parent::__construct();

        $this->configure([
            'assets' => [
                'css' => [],
                'js' => []
            ]
        ]);
    }

    public function beforeView()
    {
        //$slug = request('slug');

        View::share('assets', $this->getConfig()['assets']);
        View::share('screen', $this->getScreen());
    }

    public function getScreen(): string
    {
        list($main) = explode('.', \Request::route()->getName());
        return $main;
    }

    public function getControllerName()
    {
        $list = explode('\\', get_class($this));
        end($list);

        return strtolower(str_replace('Controller', '', current($list)));
    }

    public function addIndexAssets()
    {
        $this->config['assets']['js'][]  = 'resources/pages/'.$this->getControllerName().'/index.js';
        $this->config['assets']['css'][] = 'resources/pages/'.$this->getControllerName().'/index.css';
    }

    public function addShowAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }

        $this->config['assets']['js'][]  = 'resources/pages/'.$this->getControllerName().'/show.js';
        $this->config['assets']['css'][] = 'resources/pages/'.$this->getControllerName().'/show.css';
    }

    public function addCreateAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }

        $this->config['assets']['js'][]  = 'resources/pages/'.$this->getControllerName().'/create.js';
        $this->config['assets']['css'][] = 'resources/pages/'.$this->getControllerName().'/create.css';
    }

    public function addListAssets()
    {
        $this->config['assets']['js'][]  = 'resources/pages/'.$this->getControllerName().'/list.js';
        $this->config['assets']['css'][] = 'resources/pages/'.$this->getControllerName().'/list.css';
    }
}