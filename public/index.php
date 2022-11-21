<?php
declare(strict_types=1);
declare(ticks=1);

require_once('Services/GracefulShutdown.php');
require_once('Services/Logger.php');

use Services\GracefulShutdown;
use Services\Logger;

$shutdown = new GracefulShutdown();
$logger = new Logger();

$logger->info('Start process');

while (!$shutdown->signalReceived()) {
    $logger->info('Processing...');
    sleep(1);
}

$logger->info('Finish process');
$logger->info('Graceful shutdown!');
