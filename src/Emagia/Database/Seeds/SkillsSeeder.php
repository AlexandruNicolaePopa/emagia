<?php


use Phinx\Seed\AbstractSeed;

class SkillsSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'character_id' => 1,
                'name' => 'Rapid Strike',
                'value'  => 2,
                'chance' => 10,
                'action' => 'attack',

            ], [
                'character_id' => 1,
                'name' => 'Magic Shield',
                'value'  => 0.5,
                'chance' => 20,
                'action' => 'defend',
            ]
        ];

        $posts = $this->table('skills');
        $posts->insert($data)
            ->saveData();
    }
}
