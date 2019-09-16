<?php declare(strict_types=1);

namespace App\Service\Domain;

class TripDay implements \JsonSerializable
{
    /**
     * @var DayActivity
     */
    private $activity;

    /**
     * @return DayActivity
     */
    public function getActivity(): DayActivity
    {
        return $this->activity;
    }

    /**
     * @param DayActivity $activity
     *
     * @return TripDay
     */
    public function setActivity(DayActivity $activity): TripDay
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'activities' => $this->activity,
        ];
    }
}
