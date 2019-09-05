<?php
namespace App\Refactoring\After;

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    private $title;
    private $price;


    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->setPriceCode($priceCode);

    }

    public function getPriceCode()
    {
        return $this->price->getPriceCode();
    }

    public function setPriceCode(int $arg)
    {
        switch ($arg) {
            case Movie::REGULAR:
                $this->price = new RegularPrice();
                break;
            case Movie::CHILDRENS:
                $this->price = new ChildrensPrice();
                break;
            case Movie::NEW_RELEASE:
                $this->price = new NewReleasePrice();
                break;
            default:
                throw new \Exception("Incorrect Price Code");
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCharge(int $daysRented)
    {
        return $this->price->getCharge($daysRented);
    }

    public function getFrequentRenterPoints(int $daysRented)
    {
        if (($this->getPriceCode() == Movie::NEW_RELEASE)  && $daysRented > 1) {
            return 2;
        }
        return 1;
    }

}