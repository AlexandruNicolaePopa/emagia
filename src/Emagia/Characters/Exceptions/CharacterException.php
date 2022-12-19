<?php

namespace Emagia\Characters\Exceptions;

class CharacterException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct('Character exception: ' . $message);
    }
}
