<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Core;

use PayUSdk\Log\DefaultLogFactory;
use Psr\Log\LoggerInterface;

/**
 * Class LoggingManager
 *
 * Simple Logging Manager.
 *
 * @package PayUSdk\Framework\Core
 */
class LoggingManager
{
    /**
     * @var array of logging manager instances with class name as key
     */
    private static array $instances = [];

    /**
     * The logger to be used for all messages
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * Logger Name
     *
     * @var string
     */
    private string $loggerName;

    /**
     * Default Constructor
     *
     * @param string $loggerName Generally represents the class name.
     */
    private function __construct(string $loggerName)
    {
        $config = ConfigManager::getInstance()->getConfigHashmap();

        // Checks if custom factory defined, and is it an implementation of @PayULogFactory
        $factory = array_key_exists('log.adapter_factory', $config)
        && in_array('PayUSdk\Log\PayULogFactory', (array)class_implements($config['log.adapter_factory']))
            ? $config['log.adapter_factory']
            : '\PayUSdk\Log\DefaultLogFactory';

        /** @var DefaultLogFactory $factoryInstance */
        $factoryInstance = new $factory();
        $this->logger = $factoryInstance->getLogger($loggerName);
        $this->loggerName = $loggerName;
    }

    /**
     * Returns the singleton object
     *
     * @param string $loggerName
     * @return $this
     */
    public static function getInstance(string $loggerName = __CLASS__): LoggingManager|static
    {
        if (array_key_exists($loggerName, LoggingManager::$instances)) {
            return LoggingManager::$instances[$loggerName];
        }

        $instance = new self($loggerName);
        LoggingManager::$instances[$loggerName] = $instance;

        return $instance;
    }

    /**
     * Log Error
     *
     * @param string $message
     */
    public function error(string $message): void
    {
        $this->logger->error($message);
    }

    /**
     * Log Warning
     *
     * @param string $message
     */
    public function warning(string $message): void
    {
        $this->logger->warning($message);
    }

    /**
     * Log Fine
     *
     * @param string $message
     */
    public function fine(string $message): void
    {
        $this->info($message);
    }

    /**
     * Log Info
     *
     * @param string $message
     */
    public function info(string $message): void
    {
        $this->logger->info($message);
    }

    /**
     * Log Debug
     *
     * @param string $message
     * @return void
     */
    public function debug(string $message): void
    {
        $config = ConfigManager::getInstance()->getConfigHashmap();
        // Disable debug in live mode.
        if (array_key_exists('mode', $config) && $config['mode'] != 'live') {
            $this->logger->debug($message);
        }
    }
}
