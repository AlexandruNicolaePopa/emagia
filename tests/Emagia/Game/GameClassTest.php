<?php

use PHPUnit\Framework\TestCase;
use Emagia\Game\Classes\GameClass;
use Emagia\Characters\Classes\NPCClass;

class GameClassTest extends TestCase
{
    public function testStartRound()
    {
        // Create instances of the characters to use as the attacker and defender
        $attacker = new NPCClass(1, 'attacker');
        $defender = new NPCClass(2, 'defender');

        // Set the attacker and defender objects with appropriate values for their attributes
        $attacker->setStrength(10);
        $attacker->setLuck(0);
        $defender->setDefence(5);
        $defender->setLuck(0);
        $defender->setHealth(100);

        // Create an instance of the GameClass class
        $game = new GameClass([$attacker, $defender]);

        // Call the startRound() method on the game instance
        $game->startRound($attacker, $defender);

        // Assert that the health attribute of the defender object has been updated correctly
        $this->assertEquals(95, $defender->getHealth());
    }

    // We could test the other methods like attack or defend with \ReflectionClass(), 
    // get the private/protected property, make it accessible and then assign it's value to an 
    // instance of a newly created class. 
    // Or we could test the public methods that calls/sets/gets the private methods/properties
}
