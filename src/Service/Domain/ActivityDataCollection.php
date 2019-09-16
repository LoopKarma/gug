<?php declare(strict_types=1);

namespace App\Service\Domain;

class ActivityDataCollection
{
    /**
     * @var ActivityData[]
     */
    private $data;

    /**
     * @return ActivityData[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function addData(ActivityData $activityData): ActivityDataCollection
    {
        $this->data[] = $activityData;

        return $this;
    }

    /**
     * @param ActivityData[] $data
     *
     * @return ActivityDataCollection
     */
    public function setData(array $data): ActivityDataCollection
    {
        $this->data = $data;

        return $this;
    }
}
