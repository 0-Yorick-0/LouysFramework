<?php declare(strict_types=1);

use Migrations\Migration201906092111;

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

$injector = include(ROOT_DIR.'/src/Dependencies.php');

$connection = $injector->make('Doctrine\DBAL\Connection');

$migration = new Migration201906092111($connection);
$migration->migrate();

echo 'Finished running migration' . PHP_EOL;