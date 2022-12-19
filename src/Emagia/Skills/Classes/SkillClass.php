<?php

namespace Emagia\Skills\Classes;

use Assert\Assertion;
use Emagia\Skills\Exceptions\SkillsException;

/**
 * @property string $skillName
 * @property float $skillValue
 * @property int $skillChance
 * @property string $affectedAction
 */
final class SkillClass
{
    private string $skillName;
    private float $skillValue;
    private int $skillChance;
    private string $affectedAction;

    public function __construct(
        string $skillName,
        float $skillValue,
        int $skillChance,
        string $affectedAction

    ) {
        Assertion::notEmpty($skillName, new SkillsException('Skill name is required.'));
        Assertion::float($skillValue);
        Assertion::integer($skillChance);
        Assertion::string($affectedAction);

        $this->skillName = $skillName;
        $this->skillValue = $skillValue;
        $this->skillChance = $skillChance;
        $this->affectedAction = $affectedAction;
    }

    public function getSkillName(): string
    {
        return $this->skillName;
    }

    public function getSkillValue(): float
    {
        return $this->skillValue;
    }

    public function getSkillChance(): int
    {
        return $this->skillChance;
    }

    public function getAffectedAction(): string
    {
        return $this->affectedAction;
    }
}
