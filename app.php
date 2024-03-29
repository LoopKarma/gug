#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Command\CalculatorCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new CalculatorCommand());
$app->run();
