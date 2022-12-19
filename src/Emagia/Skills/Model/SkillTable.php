<?php

namespace Emagia\Skills\Model;

use RuntimeException;
use Emagia\Database\Classes\TableGatewayClass;

class SkillTable
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

    public function getSkill($id)
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

    public function getSkillsByCharacterId($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['character_id' => $id]);

        return $rowset;
    }

    public function saveSkill(SkillModel $skill)
    {
        $data = [
            'character_id' => $skill->characterId,
            'name' => $skill->name,
            'value'  => $skill->value,
            'chance' => $skill->chance,
            'action' => $skill->action,
        ];

        $id = (int) $skill->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getSkill($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update skill with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteSkill($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
