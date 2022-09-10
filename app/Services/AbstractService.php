<?php

namespace Zevitagem\LaravelSaasTemplateCore\Services;

use Zevitagem\LaravelSaasTemplateCore\Handlers\AbstractHandler;
use Zevitagem\LaravelSaasTemplateCore\Validators\AbstractValidator;
use Zevitagem\LaravelSaasTemplateCore\Exceptions\ValidatorException;
use Zevitagem\LaravelSaasTemplateCore\Traits\AvailabilityWithDependencie;

abstract class AbstractService
{
    use AvailabilityWithDependencie;
    
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

        $handler->setData($data);
        $handler->run($method);
    }

    public function validate(array $data, string $method)
    {
        $validator = $this->validator;
        $validator->setData($data);

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
