<?php

namespace Emagia\Characters\Model;

use RuntimeException;
use Emagia\Database\Classes\TableGatewayClass;

class CharacterTable
{
    private $tableGateway;

    public function __construct(TableGatewayClass $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getCharacter($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveCharacter(CharacterModel $character)
    {
        $data = [
            'character_id' => $character->characterId,
            'name' => $character->name,
            'health_min' => $character->healthMin,
            'health_max'  => $character->healthMax,
            'strength_min' => $character->strengthMin,
            'strength_max' => $character->strengthMax,
            'defence_min' => $character->defenceMin,
            'defence_max' => $character->defenceMax,
            'speed_min' => $character->speedMin,
            'speed_max' => $character->speedMax,
            'luck_min' => $character->luckMin,
            'luck_max' => $character->luckMax,
            'type' => $character->type,
        ];

        $id = (int) $character->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getCharacter($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update character with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deletecharacter($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
