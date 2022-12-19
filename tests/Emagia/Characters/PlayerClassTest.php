<?php

use PHPUnit\Framework\TestCase;
use Emagia\Characters\Classes\PlayerClass;
use Emagia\Skills\Classes\SkillClass;

class PlayerClassTest extends TestCase
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

        $player = new PlayerClass($id, $characterName);

        $player->setHealth($health);
        $player->setStrength($strength);
        $player->setDefence($defence);
        $player->setSpeed($speed);
        $player->setLuck($luck);


        $this->assertSame($id, $player->getId());
        $this->assertSame($characterName, $player->getCharacterName());
        $this->assertSame($health, $player->getHealth());
        $this->assertSame($strength, $player->getStrength());
        $this->assertSame($defence, $player->getDefence());
        $this->assertSame($speed, $player->getSpeed());
        $this->assertSame($luck, $player->getLuck());
    }

    public function testSetSkillMethodAddsSkillToSkillsArray()
    {
        $player = new PlayerClass(1, 'Hero');

        $skillName = 'Heal';
        $skillValue = 50.0; //to make sure to test float
        $skillChance = 20;
        $affectedAction = 'defense';

        $player->setSkill($skillName, $skillValue, $skillChance, $affectedAction);

        $this->assertCount(1, $player->getSkills());
        $this->assertInstanceOf(SkillClass::class, $player->getSkills()[0]);
        $this->assertSame($skillName, $player->getSkills()[0]->getSkillName());
        $this->assertSame($skillValue, $player->getSkills()[0]->getSkillValue());
        $this->assertSame($skillChance, $player->getSkills()[0]->getSkillChance());
        $this->assertSame($affectedAction, $player->getSkills()[0]->getAffectedAction());
    }
}
