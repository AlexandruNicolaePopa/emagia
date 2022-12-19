<?php

namespace Tests\Emagia\Characters;

use PHPUnit\Framework\TestCase;
use Emagia\Characters\Classes\CharactersAbstractClass;

/**
 * This test case includes tests for the following scenarios:

 * The class's constructor throws an exception if the character name is empty
 * The setters and getters work correctly
 */
class CharactersAbstractClassTest extends TestCase
{
    public function testSettersAndGettersWorkCorrectly()
    {
        $id = 1;
        $characterName = 'Hero';
        $health = 100;
        $strength = 50;
        $defence = 30;
        $speed = 20;
        $luck = 10;

        $character = $this->getMockForAbstractClass(CharactersAbstractClass::class, [$id, $characterName]);

        $character->setHealth($health);
        $character->setStrength($strength);
        $character->setDefence($defence);
        $character->setSpeed($speed);
        $character->setLuck($luck);

        $this->assertSame($id, $character->getId());
        $this->assertSame($characterName, $character->getCharacterName());
        $this->assertSame($health, $character->getHealth());
        $this->assertSame($strength, $character->getStrength());
        $this->assertSame($defence, $character->getDefence());
        $this->assertSame($speed, $character->getSpeed());
        $this->assertSame($luck, $character->getLuck());
    }

    public function testConstructorThrowsExceptionIfCharacterNameIsEmpty()
    {
        $this->expectException(\Assert\InvalidArgumentException::class);
        $this->expectExceptionMessage('Character name cannot be empty');

        $id = 1;
        $characterName = '';

        $this->getMockForAbstractClass(CharactersAbstractClass::class, [$id, $characterName]);
    }
}
