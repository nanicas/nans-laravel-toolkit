<?php

namespace Zevitagem\LaravelSaasTemplateCore\Exceptions;

class CrudException extends \Exception
{
    public function __construct(
        string $message = "", int $code = 0, \Throwable $previous = null
    )
    {
        $message = view(
            'components.validator-messages', ['messages' => [$message]]
        )->render();

        parent::__construct($message, $code, $previous);
    }
}