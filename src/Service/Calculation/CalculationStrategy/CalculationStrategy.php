<?php declare(strict_types=1);


namespace App\Service\Calculation\CalculationStrategy;

use App\Service\Domain\ActivityDataCollection;
use App\Service\Domain\TripOffer;

interface CalculationStrategy
{
    const MIN_ACTIVITIES_PER_DAY = 3;
    const MIN_BUDGET_USAGE_PERSENT = 60;
    public function calculate(ActivityDataCollection $data, int $budget, int $days): TripOffer;
}
