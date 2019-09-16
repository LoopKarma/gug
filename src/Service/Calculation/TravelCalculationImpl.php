<?php declare(strict_types=1);

namespace App\Service\Calculation;

use App\Service\Calculation\CalculationStrategy\CalculationStrategy;
use App\Service\DataProvider\DataProvider;
use App\Service\Domain\ActivityDataCollection;
use App\Service\Domain\TripOffer;
use App\Service\Parser\ActivityDataParser;

class TravelCalculationImpl implements TravelCalculation
{
    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * @var ActivityDataParser
     */
    private $dataParser;

    /**
     * @var CalculationStrategy
     */
    private $calculationStrategy;

    /**
     * TravelCalculationImpl constructor.
     *
     * @param DataProvider        $dataProvider
     * @param ActivityDataParser  $dataParser
     * @param CalculationStrategy $calculationStrategy
     */
    public function __construct(DataProvider $dataProvider, ActivityDataParser $dataParser, CalculationStrategy $calculationStrategy)
    {
        $this->dataProvider = $dataProvider;
        $this->dataParser = $dataParser;
        $this->calculationStrategy = $calculationStrategy;
    }

    /**
     * @param int $budget
     * @param int $days
     *
     * @return TripOffer
     */
    public function calculate(int $budget, int $days): TripOffer
    {
        $dataCollection = $this->prepareData();
        return $this->calculationStrategy->calculate($dataCollection, $budget, $days);
    }

    private function prepareData(): ActivityDataCollection
    {
        $rawData = $this->dataProvider->getData();
        return $this->dataParser->parseData($rawData);
    }
}
