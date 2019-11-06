<?php namespace Mothership;

use Mothership\Payload\Level;
use Mothership\Handlers\FatalHandler;
use Mothership\Handlers\ErrorHandler;
use Mothership\Handlers\ExceptionHandler;

class Logger
{
    /**
     * @var Client
     */
    private static $client = null;
    private static $fatalHandler = null;
    private static $errorHandler = null;
    private static $exceptionHandler = null;

    public static function error($toLog, $extra = array())
    {
        return self::log(Level::ERROR, $toLog, $extra);
    }

    public static function info($toLog, $extra = array())
    {
        return self::log(Level::INFO, $toLog, $extra);
    }

    public static function warning($toLog, $extra = array())
    {
        return self::log(Level::WARNING, $toLog, $extra);
    }

    public static function flushAndWait()
    {
        if (is_null(self::$client))
        {
            return;
        }
        self::$client->flushAndWait();
    }

    private static function init(
        $configOrClient,
        $handleException = true,
        $handleError = true,
        $handleFatal = true
    )
    {
        $setupHandlers = is_null(self::$client);

        self::setLogger($configOrClient);

        if ($setupHandlers)
        {
            if ($handleException)
            {
                self::setupExceptionHandling();
            }
            if ($handleError)
            {
                self::setupErrorHandling();
            }
            if ($handleFatal)
            {
                self::setupFatalHandling();
            }
            self::setupBatchHandling();
        }
    }

    private static function setLogger($configOrClient)
    {
        if ($configOrClient instanceof Client)
        {
            $client = $configOrClient;
        }

        if (self::$client && !isset($client))
        {
            self::$client->configure($configOrClient);

            return;
        }

        self::$client = isset($client) ? $client : new Client($configOrClient);
    }

    private static function log($level, $toLog, $extra = array(), $isUncaught = false)
    {
        return self::$client->log($level, $toLog, (array)$extra, $isUncaught);
    }

    private static function setupExceptionHandling()
    {
        self::$exceptionHandler = new ExceptionHandler(self::$client);
        self::$exceptionHandler->register();
    }

    private static function setupErrorHandling()
    {
        self::$errorHandler = new ErrorHandler(self::$client);
        self::$errorHandler->register();
    }

    private static function setupFatalHandling()
    {
        self::$fatalHandler = new FatalHandler(self::$client);
        self::$fatalHandler->register();
    }

    private static function setupBatchHandling()
    {
        register_shutdown_function('Mothership\Logger::flushAndWait');
    }

}
