<?php

namespace App\Services;

class Score
{
    /**
     * @param int $number
     * @return float|int
     */
    public function calculateScore(int $number): float|int
    {
        if ($number % 2 === 0) {
            return match (true) {
                $number > 900 => $number * 70 / 100,
                $number > 600 => $number * 60 / 100,
                $number > 300 => $number * 30 / 100,
                default => $number * 10 / 100,
            };
        }
        return 0;
    }
}
