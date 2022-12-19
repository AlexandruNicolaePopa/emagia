<?php

namespace Emagia\Characters\Classes;

use Assert\Assertion;
use Emagia\Characters\Exceptions\CharacterException;

/**
 * Created an abstract class instead of an interface because of the use of methods and properties
 * @property int $id
 * @property string $characterName
 * @property int $health
 * @property int $strength
 * @property int $defence
 * @property int $speed
 * @property int $luck
 */
abstract class CharactersAbstractClass
{
    protected int $id;
    protected string $characterName;
    protected int $health;
    protected int $strength;
    protected int $defence;
    protected int $speed;
    protected int $luck;

    public function __construct(
        int $id,
        string $characterName
    ) {
        Assertion::notEmpty($characterName, new CharacterException('Character name cannot be empty'));
        $this->setCharacterId($id);
        $this->setCharacterName($characterName);
    }

    public function setCharacterId(int $id)
    {
        $this->id = $id;
    }

    public function setCharacterName(string $characterName)
    {
        $this->characterName = $characterName;
    }

    public function setHealth(int $health)
    {
        $this->health = $health;
    }

    public function setStrength(int $strength)
    {
        $this->strength = $strength;
    }

    public function setDefence(int $defence)
    {
        $this->defence = $defence;
    }

    public function setSpeed(int $speed)
    {
        $this->speed = $speed;
    }

    public function setLuck(int $luck)
    {
        $this->luck = $luck;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCharacterName(): string
    {
        return $this->characterName;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }
}
