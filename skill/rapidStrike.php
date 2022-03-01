<?php

class rapidStrike
{
    /**
     * @param $str
     * @param $def
     * @return int
     * Calculate damage when skill Rapid Strike is used.
     */

    public function skillRapidStrike($str,$def):int
    {
        $skillStats = include '../config/skillStats.php';
        $skill = $skillStats['RapidStrike']['Multiplier'];
        return ($str - $def) * $skill;
    }
}