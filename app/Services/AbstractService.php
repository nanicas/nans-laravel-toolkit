<?php

namespace App\Services;

use App\Handlers\AbstractHandler;
use app\validators\AbstractValidator;
use App\Exceptions\ValidatorException;
use App\Traits\AvailabilityWithDependencie;

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

    //public function setRepository(RepositoryContract $repository)
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function getTable()
    {
        return $this->repository->getTable();
    }
}
