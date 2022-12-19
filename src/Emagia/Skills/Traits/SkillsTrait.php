<?php

namespace Emagia\Skills\Traits;

use Emagia\Skills\Classes\SkillClass as Skill;

trait SkillsTrait
{
    public function setSkill($skillName, $skillValue, $skillChance, $affectedAction)
    {
        $this->skills[] = new Skill($skillName, $skillValue, $skillChance, $affectedAction);
    }
}
