<?php

class player
{
    public string $name;
    public int $hp;
    public int $strength;
    public int $defence;
    public int $speed;
    public int $luck;

    public function __construct(string $name , int $hp , int $strength , int $defence , int $speed , int $luck)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHP(): int
    {
        return $this->hp;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getDef(): int
    {
        return $this->defence;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }

    public function setHP($hp):void {
        $this->hp = $hp;
    }

}
