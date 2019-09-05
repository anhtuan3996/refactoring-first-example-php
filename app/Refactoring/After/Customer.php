<?php
namespace App\Refactoring\After;

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

        $rentals = $this->rentals;

        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($rentals as $rental) {
            $each = $rental;
            //show figures for this rental
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . (string)$each->getCharge() . "\n";
        }

        //add footer lines
        $result .= "Amount owed is " . (string)$this->getTotalCharge() . " \n";
        $result .= "You earned " . (string)$this->getTotalFrequentRenterPoints() . "frequent renter points";
        return $result;
    }

    public function htmlStatement()
    {
        $rentals = $this->rentals;
        $result = "<H1>Rentals for <EM>" . $this->getName() . "</EM></H1><P>\n";

        foreach ($rentals as $rental) {
            $each = $rental;
            //show figures for this rental
            $result .= "\t" . $each->getMovie()->getTitle() . ":" . (string)$each->getCharge() . "<BR>\n";
        }

        //add footer lines
        $result .= "<P>You owe <EM>" . (string)$this->getTotalCharge() . "</EM><P>\n";
        $result .= "On this rental you earned <EM>" . (string)$this->getTotalFrequentRenterPoints() . "</EM> frequent renter points<P>";
        return $result;
    }


    private function getTotalCharge() {
        $result = 0;
        foreach ($this->rentals as $rental) {
            $result += $rental->getCharge();
        }
        return $result;

    }

    private function getTotalFrequentRenterPoints()
    {
        $result = 0;
        foreach ($this->rentals as $rental) {
            $result += $rental->getFrequentRenterPoints();
        }
        return $result;
    }
}