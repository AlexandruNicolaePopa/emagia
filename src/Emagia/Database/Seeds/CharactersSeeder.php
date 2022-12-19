<?php


use Phinx\Seed\AbstractSeed;

class CharactersSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Orderus',
                'health_min' => 70,
                'health_max' => 100,
                'strength_min' => 70,
                'strength_max' => 80,
                'defence_min' => 45,
                'defence_max' => 55,
                'speed_min' => 40,
                'speed_max' => 50,
                'luck_min' => 10,
                'luck_max' => 30,
                'type' => 'player',

            ], [
                'name' => 'Beast',
                'health_min' => 60,
                'health_max' => 90,
                'strength_min' => 60,
                'strength_max' => 90,
                'defence_min' => 40,
                'defence_max' => 60,
                'speed_min' => 40,
                'speed_max' => 60,
                'luck_min' => 25,
                'luck_max' => 40,
                'type' => 'npc'
            ]
        ];

        $posts = $this->table('characters');
        $posts->insert($data)
            ->saveData();
    }
}
