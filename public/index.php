<?php
require __DIR__.'/../vendor/autoload.php';

use App\Refactoring\Before\Movie;
use App\Refactoring\Before\Rental;
use App\Refactoring\Before\Customer;

use App\Refactoring\After\Movie as MovieAfter;
use App\Refactoring\After\Rental as RentalAfter;
use App\Refactoring\After\Customer as CustomerAfter;


$movieTitle = "Transformer";

$priceCode = 1;


$transformerMovie = new Movie($movieTitle, $priceCode);

$rentalTransformer = new Rental($transformerMovie, 20);

$customerName = 'Nguyen Van A';
$customer = new Customer($customerName);

$customer->addRental($rentalTransformer);

echo  nl2br($customer->statement());

echo '<hr>';
echo 'After';
echo '<hr>';


$movieTitle = "Transformer";

$priceCode = 1;


$transformerMovie = new MovieAfter($movieTitle, $priceCode);
//var_dump($transformerMovie);
//die();

$rentalTransformer = new RentalAfter($transformerMovie, 20);

$customerName = 'Nguyen Van A';
$customer = new CustomerAfter($customerName);

$customer->addRental($rentalTransformer);

echo  nl2br($customer->statement());
echo  nl2br($customer->htmlStatement());