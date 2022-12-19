<?php

namespace Emagia\Game\Classes;

class GameClass
{
    const ROUNDS = 20;
    private array $characters;

    public function __construct(array $characters)
    {
        $this->characters = $characters;
    }

    private function getFirstAttacker()
    {
        usort($this->characters, function ($a, $b) {
            if ($a->getSpeed() != $b->getSpeed()) {
                return $b->getSpeed() - $a->getSpeed();
            }
            return $b->getLuck() - $a->getLuck();
        });
        return $this->characters[0];
    }

    private function attack($attacker, &$damage)
    {
        // Check if the attacker has any skills
        if (method_exists($attacker, 'getSkills') && !empty($attacker->getSkills())) {
            // Check if the attacker uses any skills
            foreach ($attacker->getSkills() as $skill) {
                if ($skill->getAffectedAction() == 'attack' && rand(0, 100) <= $skill->getSkillChance()) {
                    // Apply the effects of the skill
                    // In the case of the rapid strike I considered the twice attack as double damage
                    // to make this more generic to be able to easily implement multiple skills
                    $damage *= $skill->getSkillValue();
                    $this->formatPrintLn([], $skill->getSkillName() . ' used!');
                }
            }
        }
    }

    private function defend($defender, &$damage)
    {
        $gotLucky = false;

        // Check if the defender gets lucky and avoids the attack
        if (rand(0, 100) <= $defender->getLuck()) {
            $this->formatPrintLn([], $defender->getCharacterName() . ' was lucky and avoided the attack!');
            $damage = 0;
            $gotLucky = true;
        }

        // Check if the defender has any skills
        if (method_exists($defender, 'getSkills') && !empty($defender->getSkills()) && !$gotLucky) {
            // Check if the defender uses any skills
            foreach ($defender->getSkills() as $skill) {
                if ($skill->getAffectedAction() == 'defend' && rand(0, 100) <= $skill->getSkillChance()) {
                    // Apply the effects of the skill
                    // To be generic the magic shield will have a 0.5 value, multiplying the damage by 0.5 will
                    // get the half damage we look for so this will be a generic defence skill leaving room to 
                    // easily add more skills.
                    $damage *= $skill->getSkillValue();
                    $this->formatPrintLn([], $skill->getSkillName() . ' used!');
                }
            }
        }
    }

    public function startRound($attacker, $defender)
    {
        // Calculate the damage done by the attacker
        $damage = $attacker->getStrength() - $defender->getDefence();

        if ($damage < 0) {
            $damage = 0;
        }

        $this->attack($attacker, $damage);
        $this->defend($defender, $damage);

        // Subtract the damage from the defender's health if they didn't avoid the attack
        if ($damage > 0) {
            $defender->setHealth($defender->getHealth() - $damage);
        }

        // Output the results of the attack
        $this->formatPrintLn(['red'], $attacker->getCharacterName() . ' attacks ' . $defender->getCharacterName() . ' for ' . $damage . ' damage');
        $this->formatPrintLn(['blue'], $defender->getCharacterName() . ' has ' . $defender->getHealth() . ' health left');
    }

    public function startGame()
    {
        // Determine which character goes first
        $firstAttacker = $this->getFirstAttacker($this->characters);

        $this->formatPrintLn(['bold', 'green'], 'Game started.');
        $this->formatPrintLn(
            [],
            'The players are: ' . $this->characters[0]->getCharacterName() .
                ' (' . $this->characters[0]->getHealth() . ')' . ' and ' .
                $this->characters[1]->getCharacterName() . ' (' . $this->characters[1]->getHealth() . ')'
        );

        $this->formatPrintLn([], 'The first attacker is: ' . $firstAttacker->getCharacterName());

        // Set up a counter for the number of turns
        $turns = 0;

        // Start the game
        while ($this->characters[0]->getHealth() > 0 && $this->characters[1]->getHealth() > 0 && $turns < self::ROUNDS) {
            $this->formatPrintLn(['green'], 'Round: ' . ($turns + 1));
            // Start the round of attack and defend
            if ($firstAttacker == $this->characters[0]) {
                $this->startRound($this->characters[0], $this->characters[1]);
                if ($this->characters[1]->getHealth() > 0) {
                    $this->startRound($this->characters[1], $this->characters[0]);
                }
            } else {
                $this->startRound($this->characters[1], $this->characters[0]);
                if ($this->characters[0]->getHealth() > 0) {
                    $this->startRound($this->characters[0], $this->characters[1]);
                }
            }
            $turns++;
        }

        // Output the result of the game
        if ($this->characters[0]->getHealth() <= 0) {
            $this->formatPrintLn(['bold', 'green'], $this->characters[1]->getCharacterName() . ' wins!');
        } elseif ($this->characters[1]->getHealth() <= 0) {
            $this->formatPrintLn(['bold', 'green'], $this->characters[0]->getCharacterName() . ' wins!');
        } else {
            $this->formatPrintLn(['bold', 'green'], 'The game ended in a draw after ' . $turns . ' turns.');
        }
    }

    private function formatPrint(array $format = [], string $text = '')
    {
        $codes = [
            'bold' => 1,
            'italic' => 3, 'underline' => 4, 'strikethrough' => 9,
            'black' => 30, 'red' => 31, 'green' => 32, 'yellow' => 33, 'blue' => 34, 'magenta' => 35, 'cyan' => 36, 'white' => 37,
            'blackbg' => 40, 'redbg' => 41, 'greenbg' => 42, 'yellowbg' => 44, 'bluebg' => 44, 'magentabg' => 45, 'cyanbg' => 46, 'lightgreybg' => 47
        ];
        $formatMap = array_map(function ($v) use ($codes) {
            return $codes[$v];
        }, $format);
        echo "\e[" . implode(';', $formatMap) . 'm' . $text . "\e[0m";
    }

    private function formatPrintLn(array $format = [], string $text = '')
    {
        $this->formatPrint($format, $text);
        echo PHP_EOL;
    }
}
