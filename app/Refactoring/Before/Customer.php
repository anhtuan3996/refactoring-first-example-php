<?php
namespace App\Refactoring\Before;

class Customer
{

    private $name;
    private $rentals;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    public function getName()
    {
        return $this->name;
    }


    public function statement()
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;

        $rentals = $this->rentals;

        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($rentals as $rental) {
            $each = $rental;
            $thisAmount = 0;

            //determine amounts for each line
            switch ($each->getMovie()->getPriceCode()) {
                case Movie::REGULAR:
                    $thisAmount += 2;
                    if ($each->getDaysRented() > 2)
                        $thisAmount += ($each->getDaysRented() - 2) * 1.5;
                    break;
                case Movie::NEW_RELEASE:
                    $thisAmount += $each->getDaysRented() * 3;
                    break;
                case Movie::CHILDRENS:
                    $thisAmount += 1.5;
                    if ($each->getDaysRented() > 3)
                        $thisAmount += ($each->getDaysRented() - 3) * 1.5;
                    break;
            }

            // add frequent renter points
            $frequentRenterPoints++;

            // add bonus for a two day new release rental
            if (($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE)  && $each->getDaysRented() > 1)
                $frequentRenterPoints++;

            //show figures for this rental
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . (string)$thisAmount . "\n";
            $totalAmount += $thisAmount;
        }

        //add footer lines
        $result .= "Amount owed is " . (string)$totalAmount . " \n";
        $result .= "You earned " . (string)$frequentRenterPoints . "frequent renter points";
        return $result;
    }
}