<?php

namespace Emagia\Game\Classes;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Emagia\Game\Exceptions\GameException;
use Emagia\Characters\Classes\PlayerClass as Player;
use Emagia\Characters\Classes\NPCClass as WildBeast;
use Emagia\Skills\Model\SkillTable;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\ServiceManager\ServiceManager;
use Emagia\Database\Classes\DatabaseAdapterClass;
use Emagia\Database\Classes\TableGatewayClass;
use Psr\Log\LoggerInterface;

class GameHelperClass
{
    private $skillsTable;
    private $charactersTable;
    private $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $serviceManager = new ServiceManager([
            'factories' => [
                SkillTable::class => function ($container) {
                    $tableGateway = $container->get(SkillsTableGateway::class);
                    return new SkillTable($tableGateway);
                },
                SkillsTableGateway::class => function ($dbAdapter) {
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Emagia\Skills\Model\SkillModel());
                    $dbAdapterClass = new DatabaseAdapterClass();
                    $dbAdapter = $dbAdapterClass->getAdapter();
                    return new TableGatewayClass('skills', $dbAdapter, null, $resultSetPrototype);
                },
                CharacterTable::class => function ($container) {
                    $tableGateway = $container->get(CharactersTableGateway::class);
                    return new SkillTable($tableGateway);
                },
                CharactersTableGateway::class => function ($dbAdapter) {
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Emagia\Characters\Model\CharacterModel());
                    $dbAdapterClass = new DatabaseAdapterClass();
                    $dbAdapter = $dbAdapterClass->getAdapter();
                    return new TableGatewayClass('characters', $dbAdapter, null, $resultSetPrototype);
                },
            ],
            'aliases' => [
                'skills' => SkillTable::class,
                'characters' => CharacterTable::class,
            ]
        ]);

        $this->skillsTable = $serviceManager->get('skills');
        $this->charactersTable = $serviceManager->get('characters');
    }

    /**
     * We could either throw an exception and do a single try catch block for all the setters or
     * we could add a default property like int $default = 0 and return that if the min is larger then max
     * I went with the single try catch for now but it will be difficult to know which pair didn't pass the check
     * so this will need some rethinking
     */
    private function getRandomValue(int $min, int $max): int
    {
        Assertion::integer($min, 'Not an integer.');
        Assertion::integer($max, 'Not an integer');
        if ($min >= $max) {
            throw new GameException('The values provided for getRandomValue are not correct.', 'Game values.');
        }
        return rand($min, $max);
    }

    private function setCharacterSkills($character, &$player)
    {
        $skills = $this->getCharactersSkills($character->id);
        foreach ($skills as $skill) {
            try {
                $player->setSkill($skill->name, $skill->value, $skill->chance, $skill->action);
            } catch (AssertionFailedException $e) {
                $this->logger->error($e->getMessage(), ['exception' => $e]);
            }
        }
    }

    private function setCharacterAttributes($character, &$entity)
    {
        try {
            $entity->setHealth($this->getRandomValue($character->healthMin, $character->healthMax));
            $entity->setStrength($this->getRandomValue($character->strengthMin, $character->strengthMax));
            $entity->setDefence($this->getRandomValue($character->defenceMin, $character->defenceMax));
            $entity->setSpeed($this->getRandomValue($character->speedMin, $character->speedMax));
            $entity->setLuck($this->getRandomValue($character->luckMin, $character->luckMax));
        } catch (GameException $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e]);
        }
    }

    public function getCharacters()
    {
        $characters = [];
        $dbCharacters = $this->getCharactersFromDB();

        foreach ($dbCharacters as $character) {
            switch ($character->type) {
                case 'player':
                    $player = new Player($character->id, $character->name);
                    $this->setCharacterAttributes($character, $player);
                    $this->setCharacterSkills($character, $player);

                    $characters[] = $player;
                    break;
                case 'npc':
                    $player = new WildBeast($character->id, $character->name);
                    $this->setCharacterAttributes($character, $player);
                    $characters[] = $player;
                    break;
            }
        }

        return $characters;
    }

    private function getCharactersFromDB(): ResultSet
    {
        $characters = $this->charactersTable->fetchAll();
        return $characters;
    }

    public function getCharactersSkills($characterId): ResultSet
    {
        $skills = $this->skillsTable->getSkillsByCharacterId(1);
        return $skills;
    }
}
