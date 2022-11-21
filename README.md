# Graceful Shutdown with PHP

> Generally, a graceful shutdown is preferable in the case of any OS that saves its state. When the standard shutdown procedures are not done with these OSs, the result can be data corruption of program and operating system files. The result of the corruption can be instability, incorrect functioning or failure to boot.

For more information see [this](https://whatis.techtarget.com/definition/graceful-shutdown-and-hard-shutdown).

## How to use

```php
$shutdown = new GracefulShutdown();
$logger = new Logger();

$logger->info('Start process');

while (!$shutdown->signalReceived()) {
    $logger->info('Processing...');
    sleep(1);
}

$logger->info('Finish process');
$logger->info('Graceful shutdown!');
```

Output result with debug enabled:
```
[2022-11-21 14:37:34.659049] [INFO]: Start process
[2022-11-21 14:37:34.662771] [INFO]: Processing...
[2022-11-21 14:37:57.759536] [INFO]: Processing...
[2022-11-21 14:37:58.762715] [INFO]: Processing...
[2022-11-21 14:37:59.27428] [WARNING]: Signal received: 15
[2022-11-21 14:37:59.133600] [WARNING]: FUNCTION TO PREPARE APP TO SHUTDOWN
[2022-11-21 14:37:59.137609] [INFO]: Finish process
[2022-11-21 14:37:59.144250] [INFO]: Graceful shutdown!
```
