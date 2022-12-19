<?php

namespace Emagia\Skills\Model;

class SkillModel
{
    public $id;
    public $characterId;
    public $name;
    public $value;
    public $chance;
    public $action;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->characterId = !empty($data['character_id']) ? $data['character_id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->value  = !empty($data['value']) ? $data['value'] : null;
        $this->chance  = !empty($data['chance']) ? $data['chance'] : null;
        $this->action  = !empty($data['action']) ? $data['action'] : null;
    }
}
