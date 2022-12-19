<?php

namespace Tests\Emagia\Characters;

use PHPUnit\Framework\TestCase;
use Emagia\Characters\Classes\NPCClass;

class NPCClassTest extends TestCase
{
    public function testSettersAndGettersWorkCorrectly()
    {
        $id = 1;
        $characterName = 'Beast';
        $health = 100;
        $strength = 50;
        $defence = 30;
        $speed = 20;
        $luck = 10;

        $npc = new NPCClass($id, $characterName);

        $npc->setHealth($health);
        $npc->setStrength($strength);
        $npc->setDefence($defence);
        $npc->setSpeed($speed);
        $npc->setLuck($luck);

        $this->assertSame($id, $npc->getId());
        $this->assertSame($characterName, $npc->getCharacterName());
        $this->assertSame($health, $npc->getHealth());
        $this->assertSame($strength, $npc->getStrength());
        $this->assertSame($defence, $npc->getDefence());
        $this->assertSame($speed, $npc->getSpeed());
        $this->assertSame($luck, $npc->getLuck());
    }
}
