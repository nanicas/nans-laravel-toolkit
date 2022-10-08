<?php

namespace Zevitagem\LaravelSaasTemplateCore\Validators;

use Zevitagem\LaravelSaasTemplateCore\Helpers\Helper;
//use Zevitagem\LaravelSaasTemplateCore\Staters\AppStater;

class AbstractValidator
{
    private $data;
    private $method;
    private $withHTML = true;
    private $textSeparator = PHP_EOL;
    protected $errors = [];
    protected $messages = [];

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function setWithHTML(bool $value)
    {
        $this->withHTML = $value;
    }

    public function addError(string $key, array $data = [])
    {
        $this->errors[] = vsprintf($this->messages[$key], $data);
    }

    private function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return (!empty($this->getErrors()));
    }

    public function getTextSeparator()
    {
        return $this->textSeparator;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getData()
    {
        return $this->data;
    }

    public function run(string $method)
    {
        if (!method_exists($this, $method)) {
            return null;
        }

        $this->setMethod($method);
        $this->{$method}();

        return (empty($this->errors));
    }

    public function translate()
    {
        if (!$this->withHTML) {
            return implode($this->getTextSeparator(), $this->errors);
        }
        
        $packaged = true;//(bool) AppStater::getItem('packaged');

        return Helper::view('components.validator-messages', ['messages' => $this->errors], $packaged)->render();
    }
}
