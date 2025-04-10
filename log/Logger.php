<?php
require_once _DIR_ . '/CreateDatabaseLogger.php';

class Logger
{
    private static $logger;

    public static function init($host, $dbname, $user, $pass)
    {
        self::$logger = new CreateDatabaseLogger($host, $dbname, $user, $pass);
    }

    public static function info($message, $context = [])
    {
        self::$logger->write('info', $message, $context);
    }

    public static function error($message, $context = [])
    {
        self::$logger->write('error', $message, $context);
    }

    public static function debug($message, $context = [])
    {
        self::$logger->write('debug', $message, $context);
    }
}
