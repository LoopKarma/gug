<?php declare(strict_types=1);

namespace App\Service\Domain;

class TripOffer implements \JsonSerializable
{
    /**
     * @var int
     */
    private $budgetSpent;
    /**
     * @var TripDay[]
     */
    private $days;

    /**
     * @return int
     */
    public function getBudgetSpent(): int
    {
        return $this->budgetSpent;
    }

    /**
     * @param int $budgetSpent
     *
     * @return TripOffer
     */
    public function setBudgetSpent(int $budgetSpent): TripOffer
    {
        $this->budgetSpent = $budgetSpent;

        return $this;
    }

    /**
     * @return TripDay[]
     */
    public function getDays(): array
    {
        return $this->days;
    }

    /**
     * @param TripDay[] $days
     *
     * @return TripOffer
     */
    public function setDays(array $days): TripOffer
    {
        $this->days = $days;

        return $this;
    }

    /**
     * @param TripDay $day
     *
     * @return TripOffer
     */
    public function addDay(TripDay $day): TripOffer
    {
        $this->days[] = $day;

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return
            [
                'budgetSpent' => $this->getBudgetSpent(),
                'days' => $this->getDays(),
            ];
    }
}
