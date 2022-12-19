<?php

use Emagia\Game\Classes\GameHelperClass as GameHelper;
use Emagia\Game\Classes\GameClass as Game;
use Assert\AssertionFailedException;

require_once('vendor/autoload.php');
require_once('config.php');

$gameHelper = new GameHelper();

try {
    $characters = $gameHelper->getCharacters();
} catch (AssertionFailedException $e) {
    print_r($e->getMessage());
}

$game = new Game($characters);
$game->startGame();
