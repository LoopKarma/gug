<?php declare(strict_types=1);

namespace App\Service\Parser;

use App\Service\Domain\ActivityData;
use App\Service\Domain\ActivityDataCollection;

class JsonDataParser implements ActivityDataParser
{
    public function parseData(string $data): ActivityDataCollection
    {
        //it should be some serializer
        $result = new ActivityDataCollection();
        $items = json_decode($data, true);
        foreach ($items as $value) {
            $id = (int) $value['id'];
            $price = (int) $value['price'];
            $result->addData(new ActivityData($id, $price));
        }

        return $result;
    }
}
