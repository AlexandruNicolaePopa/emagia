<?php

namespace Emagia\Game\Exceptions;

class GameException extends \Exception
{
    private string $type;

    public function __construct(string $message, string $type)
    {
        parent::__construct('Game exception type: ' . $type . $message);
    }

    public function getType(): string
    {
        return $this->type;
    }
}
