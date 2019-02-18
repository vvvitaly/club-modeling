#!/usr/bin/env php
<?php declare(strict_types=1);

use Club\Emulating\ConfigurationFactory;
use Club\Emulating\Emulator;
use Club\Emulating\StatePrinter;
use Faker\Factory;
use League\CLImate\CLImate;
use League\CLImate\Exceptions\InvalidArgumentException as CliInvalidArgumentException;

require_once __DIR__ . '/vendor/autoload.php';

$cli = new CLImate();

$cli->description('Club emulation runner');
$cli->arguments->add([
    'config' => [
        'description' => 'The path to emulation configuration file (for example config/example.php)',
        'required' => true,
    ],
]);

try {
    $cli->arguments->parse();
} catch (CliInvalidArgumentException $exception) {
    $cli->error($exception->getMessage());
    $cli->usage();
    exit(1);
}

$configFile = $cli->arguments->get('config');
if (!file_exists($configFile)) {
  $cli->error("Config file \"{$configFile}\" does not exists");
  exit(1);
}

$config = require $configFile;

$configFactory = new ConfigurationFactory($config, Factory::create('ru_RU'));
try {
    $configuration = $configFactory->createConfiguration();
} catch (InvalidArgumentException $e) {
    $cli->error('Can not create configuration: ' . $e->getMessage());
    exit(1);
}

$printer = new StatePrinter($cli);

$emulator = new Emulator($configuration, $printer);
$emulator->run();