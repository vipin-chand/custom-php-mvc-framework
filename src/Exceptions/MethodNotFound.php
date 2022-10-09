<?php

namespace App\Exceptions;

class MethodNotFound extends \Exception
{
    public $message = 'This Method not found';

    public function message(): string
    {
        return $this->message;
    }
}