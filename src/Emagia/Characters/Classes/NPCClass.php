<?php

namespace Emagia\Characters\Classes;

use Emagia\Characters\Classes\CharactersAbstractClass;

/**
 * Maybe use this for further characters classification as Goblin, Ogre, Dragon
 */
class NPCClass extends CharactersAbstractClass
{
    public function __construct(
        int $id,
        string $characterName
    ) {
        parent::__construct($id, $characterName);
    }
}
