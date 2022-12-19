<?php

namespace Emagia\Skills\Exceptions;

class SkillsException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct('Skill not added. ' . $message);
    }
}
