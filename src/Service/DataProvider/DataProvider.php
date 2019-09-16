<?php declare(strict_types=1);


namespace App\Service\DataProvider;


interface DataProvider
{
    public function getData(): string;
}
