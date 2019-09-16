<?php declare(strict_types=1);

namespace App\Command;

use App\Service\Calculation\CalculationStrategy\PlainStrategy;
use App\Service\Calculation\TravelCalculationImpl;
use App\Service\DataProvider\JsonDataProvider;
use App\Service\Parser\JsonDataParser;
use http\Exception\RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculatorCommand extends Command
{
    protected static $defaultName = 'travel:calc';

    protected function configure()
    {
        $this
            // ...
            ->addArgument('fileName', InputArgument::REQUIRED, 'Filename with data')
            ->addArgument('budget', InputArgument::REQUIRED, 'Budget')
            ->addArgument('days', InputArgument::REQUIRED, 'Days')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $budget = (int) $input->getArgument('budget');
        $days = (int) $input->getArgument('days');
        $fileName = (string) $input->getArgument('fileName');
        if ($budget > 2000 || $budget < 250) {
            throw new \RuntimeException('Budget should be in [250, 2000]');
        }
        if ($days < 1 || $days > 5) {
            throw new \RuntimeException('Days should be in [1, 5]');
        }

        $jsonDataProvider = new JsonDataProvider($fileName);
        $jsonDataParser = new JsonDataParser();
        $plainCalculationStrategy = new PlainStrategy();

        $travelCalculator = new TravelCalculationImpl(
            $jsonDataProvider,
            $jsonDataParser,
            $plainCalculationStrategy
        );

        $result = $travelCalculator->calculate($budget, $days);

        $output->write(json_encode($result));

//        parent::execute($input, $output); // TODO: Change the autogenerated stub
    }

}