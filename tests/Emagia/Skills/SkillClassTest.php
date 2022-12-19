<?php

namespace tests\Emagia\Skills;

use PHPUnit\Framework\TestCase;
use Emagia\Skills\Classes\SkillClass;

class SkillClassTest extends TestCase
{
    public function testConstructAndGetters()
    {
        $skill = new SkillClass('Rapid Strike', 2, 50, 'attack');

        $this->assertEquals('Rapid Strike', $skill->getSkillName());
        $this->assertEquals(2, $skill->getSkillValue());
        $this->assertEquals(50, $skill->getSkillChance());
        $this->assertEquals('attack', $skill->getAffectedAction());
    }

    public function testConstructThrowsExceptionWhenSkillNameIsEmpty()
    {
        $this->expectException(\Assert\InvalidArgumentException::class);
        $this->expectExceptionMessage('Skill name is required.');

        new SkillClass('', 2, 50, 'attack');
    }
}
