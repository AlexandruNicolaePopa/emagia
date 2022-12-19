<?php

namespace Emagia\Characters\Model;

class CharacterModel
{
    public $id;
    public $name;
    public $healthMin;
    public $healthMax;
    public $strengthMin;
    public $strengthMax;
    public $defenceMin;
    public $defenceMax;
    public $speedMin;
    public $speedMax;
    public $luckMin;
    public $luckMax;
    public $type;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->healthMin = !empty($data['health_min']) ? $data['health_min'] : null;
        $this->healthMax = !empty($data['health_max']) ? $data['health_max'] : null;
        $this->strengthMin = !empty($data['strength_min']) ? $data['strength_min'] : null;
        $this->strengthMax = !empty($data['strength_max']) ? $data['strength_max'] : null;
        $this->defenceMin = !empty($data['defence_min']) ? $data['defence_min'] : null;
        $this->defenceMax = !empty($data['defence_max']) ? $data['defence_max'] : null;
        $this->speedMin = !empty($data['speed_min']) ? $data['speed_min'] : null;
        $this->speedMax = !empty($data['speed_max']) ? $data['speed_max'] : null;
        $this->luckMin = !empty($data['luck_min']) ? $data['luck_min'] : null;
        $this->luckMax = !empty($data['luck_max']) ? $data['luck_max'] : null;
        $this->type = !empty($data['type']) ? $data['type'] : null;
    }
}
