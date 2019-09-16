<?php declare(strict_types=1);

namespace App\Service\Parser;

use App\Service\Domain\ActivityDataCollection;

interface ActivityDataParser
{
    public function parseData(string $data): ActivityDataCollection;
}
