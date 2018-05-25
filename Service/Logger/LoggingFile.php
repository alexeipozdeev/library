<?php

namespace Service\Logger;


class LoggingFile implements LoggerInterface
{
    /**
     * Пишем ошибку в лог ошибок
     *
     * @param string $error
     */
    public function error(string $error): void
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/error_log_scanner.txt';
        $log = fopen($file, 'a');
        fwrite($log, $error);
        fclose($log);
    }

    /**
     * Пишем сообщение в лог информации
     *
     * @param string $info
     */
    public function info(string $info): void
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/log_scanner.txt';
        $log = fopen($file, 'a');
        fwrite($log, $info);
        fclose($log);
    }
}