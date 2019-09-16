<?php declare(strict_types=1);

namespace App\Service\Domain;

class ActivityData
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $price;

    /**
     * ActivityData constructor.
     *
     * @param int $id
     * @param int $price
     */
    public function __construct(int $id, int $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return ActivityData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return ActivityData
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}
