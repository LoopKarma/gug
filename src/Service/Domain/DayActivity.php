<?php declare(strict_types=1);

namespace App\Service\Domain;

class DayActivity implements \JsonSerializable
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

    /**
     * @param ActivityData[] $data
     *
     * @return DayActivity
     */
    public function setData(array $data): DayActivity
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $result = [];
        foreach ($this->data as $datum) {
            $result[] = [
                'id' => $datum->getId(),
                'price' => $datum->getPrice(),
            ];
        }

        return $result;
    }
}
