<?php declare(strict_types=1);


namespace App\Service\Calculation;


use App\Service\Domain\TripOffer;

interface TravelCalculation
{
    public function calculate(int $budget, int $days): TripOffer;
}
