<?php

class magicShield
{
    /**
     * @param $str
     * @param $def
     * @return int
     * Calculate damage when skill Magic Shield is used.
     */

    public function skillMagicShield($str,$def):int
    {
        $skillStats = include '../config/skillStats.php';
        $skill = $skillStats['MagicShield']['HealthReduction'];
        return ($str - $def) / $skill;
    }
}