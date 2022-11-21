<?php declare(strict_types=1);

namespace Services;

class GracefulShutdown
{
    /**
     * @var int|null
     */
    protected ?int $signal = null;

    /**
     * @var array
     */
    protected array $signals = [
        SIGINT,
        SIGTERM,
    ];

    protected Logger $logger;

    /**
     * @param array $signals
     * @param bool $debug
     */
    public function __construct(
        protected bool $debug = true,
        array $signals = []
    ) {
        $this->logger = new Logger();
        $this->signals = array_merge($this->signals, $signals);
        $this->registerSignals();
    }

    /**
     * @param int $signal
     */
    public function __invoke(int $signal)
    {
        $this->signal = $signal;
        $this->debug();
        pcntl_async_signals(false);
    }

    /**
     * @return bool
     */
    public function signalReceived(): bool
    {
        return is_int($this->signal);
    }

    protected function registerSignals(): void
    {
        pcntl_async_signals(true);
        foreach ($this->signals as $signal) {
            pcntl_signal($signal, $this);
        }
    }

    protected function debug(): void
    {
        if ($this->debug) {
            $this->logger->warning(sprintf('Signal received: %s', $this->signal));
            usleep(100000); # 0,1 seconds
            $this->logger->warning('FUNCTION TO PREPARE APP TO SHUTDOWN');
        }
    }
}
