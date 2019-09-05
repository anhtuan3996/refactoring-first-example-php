<?php
namespace App\Refactoring\After;

abstract class Price {
    abstract public function getPriceCode();
    abstract function getCharge(int $daysRented);
    public function getFrequentRenterPoints(int $daysRented)
    {
        return 1;
    }
}