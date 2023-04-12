<?php

namespace Zevitagem\LaravelToolkit\Services;

use Zevitagem\LaravelToolkit\Handlers\AbstractHandler;
use Zevitagem\LaravelToolkit\Validators\AbstractValidator;
use Zevitagem\LaravelToolkit\Exceptions\ValidatorException;
use Zevitagem\LaravelToolkit\Traits\AvailabilityWithDependencie;
use Zevitagem\LaravelToolkit\Traits\Configurable;

abstract class AbstractService
{
    use AvailabilityWithDependencie, Configurable;
    
    protected $handler;
    protected $validator;
    protected $repository;

    public function getRepository()
    {
        return $this->repository;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator(AbstractValidator $validator)
    {
        $this->validator = $validator;
    }

    public function setHandler(AbstractHandler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(array &$data, string $method)
    {
        $handler = $this->getHandler();

        $handler->setRequest($this->getConfigIndex('request'));
        $handler->setData($data);
        $handler->run($method);
    }

    public function validate(array $data, string $method)
    {
        $validator = $this->validator;
        $validator->setData($data);
        $validator->setRequest($this->getConfigIndex('request'));

        if ($validator->run($method) === false) {
            throw new ValidatorException($validator->translate());
        }

        return true;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function getTable()
    {
        return $this->repository->getTable();
    }

    public function getColumnsObject()
    {
        return $this->repository->getColumnsObject();
    }

    public function showColumns(string $table = '')
    {
        $data = $this->repository->showColumns($table);

        return array_map(function ($item) {
            return $item['Field'];
        }, $data);
    }
}
