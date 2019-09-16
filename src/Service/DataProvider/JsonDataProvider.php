<?php declare(strict_types=1);

namespace App\Service\DataProvider;

class JsonDataProvider implements DataProvider
{
    private $fileName;

    /**
     * JsonDataProvider constructor.
     *
     * @param $fileName
     */
    public function __construct($fileName, $folder = 'data')
    {
        $this->fileName = $folder.'/'.$fileName;
    }

    public function getData(): string
    {
        if (!file_exists($this->fileName)) {
            throw new \RuntimeException(sprintf('File is not exist: %s', $this->fileName));
        }
        return file_get_contents($this->fileName);
    }
}
