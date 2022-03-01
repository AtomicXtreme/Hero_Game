<?php

include('../skill/rapidStrike.php');
include('../skill/magicShield.php');

class battle
{
    public object $attacker;
    public object $defender;
    public string $name;
    private int $abilityChance;

    /**
     * @param player $hero
     * @param player $beast
     * @return void
     * Function that choose who start first
     */
    public function startFirst(player $hero, player $beast): void
    {
        $this->name = $hero->getName();

        if ($hero->getSpeed() > $beast->getSpeed() || $hero->getLuck() > $beast->getLuck()) {
            $this->attacker = $hero;
            $this->defender = $beast;
        } elseif ($hero->getSpeed() < $beast->getSpeed() || $hero->getLuck() < $beast->getLuck()) {
            $this->attacker = $beast;
            $this->defender = $hero;
        }

        if(empty($this->attacker)){
            $this->setAttackerDef($hero,$beast);
        }

    }

    /**
     * @param player $atk
     * @param player $def
     * @return void
     * Set the attacker or defender randomly
     */
    public function setAttackerDef(player $atk , player $def):void
    {
        $arrayPlayers = [$atk,$def];
        shuffle($arrayPlayers);
        $this->attacker = array_pop($arrayPlayers);
        $this->defender = array_pop($arrayPlayers);
    }

    /**
     * @return string
     * Initiate the start of battle
     */
    public function startBattle(): string
    {
        $maxRounds = require_once '../config/gameConfig.php';
        for ($round = 1; $round <= $maxRounds['Rounds']; $round++) {
            echo "<-- Round " . $round . " --><br>";
            $this->abilityChance = rand(1, 100);

            echo $this->attacker->getName() . " damage: ";
            echo $this->calcDamage($this->abilityChance);
            echo "<br>";
            $this->updateHP();
            $this->changeAttacker();

            if ($this->defender->getHP() <= 0 || $this->attacker->getHP() <= 0) {
                break;
            }

            echo $this->attacker->getName() . " damage: ";
            echo $this->calcDamage($this->abilityChance);
            echo "<br>";
            $this->updateHP();
            $this->changeAttacker();

            if ($this->defender->getHP() <= 0 || $this->attacker->getHP() <= 0) {
                break;
            }

            if ($round == 20) {
                echo "Round limit reached ! ";
                break;
            }
        }
        return $this->getWinner();

    }

    /**
     * @return void
     * Change attacker to defender
     */
    public function changeAttacker(): void
    {
        $temp = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $temp;
    }

    /**
     * @param $skillChance
     * @param $print
     * @return int
     * Calculate the damage done by attacker
     */
    public function calcDamage($skillChance, $print = NULL): int
    {
        $skill = new rapidStrike();
        $skill2 = new magicShield();

        if ($this->name == $this->attacker->getName() && $skillChance <= $this->attacker->getLuck()) {
            if ($print === NULL) {
                echo "RapidStrike was used:  ";
            }

            return $skill->skillRapidStrike($this->attacker->getStrength(), $this->defender->getDef());
        }

        if ($this->name == $this->defender->getName() && $skillChance <= $this->defender->getLuck()) {
            if ($print === NULL) {
                echo "MagicShield was used:  ";
            }

            return $skill2->skillMagicShield($this->attacker->getStrength(), $this->defender->getDef());
        }

        return $this->attacker->getStrength() - $this->defender->getDef();
    }

    /**
     * @return void
     * Update the defender health
     */
    public function updateHP(): void
    {
        $miss = rand(1, 100);
        if ($miss <= $this->defender->getLuck()) {
            echo "Attack missed! " . "<br>";
            $newHP = $this->defender->getHP();
        } else {
            $newHP = $this->defender->getHP() - $this->calcDamage($this->abilityChance, true);
        }
        if ($newHP < 0) {
            $newHP = 0;
        }
        $this->defender->setHP($newHP);

        echo $this->defender->getName() . " HP left: ";
        echo $this->defender->getHP() . "<br><br>";
    }

    /**
     * @return string
     * Return the name of the winner
     */
    public function getWinner(): string
    {
        if ($this->attacker->getHP() > $this->defender->getHP()) {
            return "Winner is: " . $this->attacker->getName();

        }
        return "Winner is: " . $this->defender->getName();

    }
}