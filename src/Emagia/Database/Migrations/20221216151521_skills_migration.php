<?php

use Phinx\Migration\AbstractMigration;

class SkillsMigration extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('skills');
        $table
            ->addColumn('character_id', 'integer')
            ->addColumn('name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('value', 'float', ['null' => true])
            ->addColumn('chance', 'integer', ['null' => true])
            ->addColumn('action', 'enum', ['null' => true, 'values' => ['attack', 'defend']])
            ->create();
    }
}
