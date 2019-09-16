<?php declare(strict_types=1);

namespace App\Service\Calculation\CalculationStrategy;

use App\Service\Domain\TripDay;
use App\Service\Domain\TripOffer;
use App\Service\Domain\DayActivity;
use App\Service\Domain\ActivityData;
use App\Service\Domain\ActivityDataCollection;
use App\Service\Exception\FailedCalculationStrategy;

class PlainStrategy implements CalculationStrategy
{
    /**
     * @param ActivityDataCollection $data
     * @param int                    $budget
     * @param int                    $days
     *
     * @return TripOffer
     */
    public function calculate(ActivityDataCollection $data, int $budget, int $days): TripOffer
    {
        $maxBudgetPerDay = $budget / $days;
        $maxBudgetPerActivity = $maxBudgetPerDay / CalculationStrategy::MIN_ACTIVITIES_PER_DAY;
        $lowBudgetThreshold = $budget * CalculationStrategy::MIN_BUDGET_USAGE_PERSENT / 100;
        $minBudgetPerDay = $lowBudgetThreshold / $days;
        $minBudgetPerActivity = $minBudgetPerDay / CalculationStrategy::MIN_ACTIVITIES_PER_DAY;

        $activitiesPool = [];
        foreach ($data->getData() as $item) {
            if ($item->getPrice() <= $maxBudgetPerActivity
                && $item->getPrice() >= $minBudgetPerActivity
                && !in_array($item, $activitiesPool)) {
                $activitiesPool[] = $item;
            }
        }

        if (count($activitiesPool) < $days * CalculationStrategy::MIN_ACTIVITIES_PER_DAY) {
            throw new FailedCalculationStrategy('PlainStrategy failed, please use another one');
        }

        shuffle($activitiesPool);

        $result = new TripOffer();
        $budgetSpent = 0;
        for ($i = 0; $i < $days; $i++) {
            $activitiesFromPool = array_slice($activitiesPool, $i, CalculationStrategy::MIN_ACTIVITIES_PER_DAY);

            $activities = (new DayActivity())->setData($activitiesFromPool);

            $budgetSpent += array_sum(array_map(function(ActivityData $data) { return $data->getPrice();}, $activities->getData()));

            $tripDay = (new TripDay())->setActivity($activities);
            $tripDay->setActivity($activities);

            $result->addDay($tripDay);
        }
        $result->setBudgetSpent($budgetSpent);

        return $result;
    }
}
