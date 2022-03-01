<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/player.php';
include '../src/battle.php';

$playerStats = require_once '../config/playerStats.php';
$beastStats = require_once '../config/beastStats.php';


$player = new Player(
    $playerStats['Name'],
    rand($playerStats['HP']['MIN'],$playerStats['HP']['MAX']),
    rand($playerStats['Strength']['MIN'],$playerStats['Strength']['MAX']),
    rand($playerStats['Defence']['MIN'],$playerStats['Defence']['MAX']),
    rand($playerStats['Speed']['MIN'],$playerStats['Speed']['MAX']),
    rand($playerStats['Luck']['MIN'],$playerStats['Luck']['MAX'])
);

$player2 = new Player(
    $beastStats['Name'],
    rand($beastStats['HP']['MIN'],$beastStats['HP']['MAX']),
    rand($beastStats['Strength']['MIN'],$beastStats['Strength']['MAX']),
    rand($beastStats['Defence']['MIN'],$beastStats['Defence']['MAX']),
    rand($beastStats['Speed']['MIN'],$beastStats['Speed']['MAX']),
    rand($beastStats['Luck']['MIN'],$beastStats['Luck']['MAX'])
);

echo $player->getName() . " ---> ";
echo ' Health: ' . $player->getHP() . ' Strength: ' . $player->getStrength() . ' Defence: ' . $player->getDef() .
    ' Speed: ' . $player->getSpeed() . ' Luck: ' . $player->getLuck();

echo "<br>";

echo $player2->getName() . " ---> ";
echo ' Health: ' . $player2->getHP() . ' Strength: ' . $player2->getStrength() . ' Defence: ' . $player2->getDef() .
    ' Speed: ' . $player2->getSpeed() . ' Luck: ' . $player2->getLuck();

echo "<br><br>";

$test = new battle();
$test->startFirst($player,$player2);
echo $test->startBattle();

