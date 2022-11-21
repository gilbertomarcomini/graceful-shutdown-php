<?php

namespace Services;

class Logger
{
    const FILE = '/app/app.log';

    /**
     * @param string $message
     * @param string $level
     */
    protected function message(string $message, string $level)
    {
        $date = date('Y-m-d H:i:s.') . gettimeofday()['usec'];
        $msg = sprintf('[%s] [%s]: %s%s', $date, $level, $message, PHP_EOL);
        file_put_contents(self::FILE, $msg, FILE_APPEND);
    }

    /**
     * @param $message
     */
    public function info($message)
    {
        $this->message($message, 'INFO');
    }

    /**
     * @param $message
     */
    public function warning($message)
    {
        $this->message($message, 'WARNING');
    }

    /**
     * @param $message
     */
    public function error($message)
    {
        $this->message($message, 'ERROR');
    }
}
