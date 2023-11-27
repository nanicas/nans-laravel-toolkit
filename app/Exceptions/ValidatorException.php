<?php

namespace Zevitagem\LaravelToolkit\Exceptions;

class ValidatorException extends \Exception
{
    public array $errors;

    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
