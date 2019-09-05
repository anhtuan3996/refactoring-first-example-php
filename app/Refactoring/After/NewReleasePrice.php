<?php

namespace App\Refactoring\After;

class NewReleasePrice extends Price
{

    public function getPriceCode()
    {
        return Movie::NEW_RELEASE;
    }
    public function getCharge(int $daysRented)
    {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented)
    {
        if ($daysRented > 1) {
            return 2;
        }
        return 1;
    }
}