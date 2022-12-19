<?php

use Phinx\Migration\AbstractMigration;

class CharacterMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters');
        $table
            ->addColumn('name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('health_min', 'integer', ['null' => true])
            ->addColumn('health_max', 'integer', ['null' => true])
            ->addColumn('strength_min', 'integer', ['null' => true])
            ->addColumn('strength_max', 'integer', ['null' => true])
            ->addColumn('defence_min', 'integer', ['null' => true])
            ->addColumn('defence_max', 'integer', ['null' => true])
            ->addColumn('speed_min', 'integer', ['null' => true])
            ->addColumn('speed_max', 'integer', ['null' => true])
            ->addColumn('luck_min', 'integer', ['null' => true])
            ->addColumn('luck_max', 'integer', ['null' => true])
            ->addColumn('type', 'enum', ['null' => true, 'values' => ['player', 'npc']])
            ->create();
    }
}
