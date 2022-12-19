<?php

namespace Emagia\Characters\Classes;

use Emagia\Characters\Classes\CharactersAbstractClass;
use Emagia\Skills\Traits\SkillsTrait;

class PlayerClass extends CharactersAbstractClass
{
    use SkillsTrait;
    private array $skills;
    public function __construct(
        int $id,
        string $characterName
    ) {
        parent::__construct($id, $characterName);
    }

    public function getSkills(): array
    {
        return $this->skills;
    }
}
