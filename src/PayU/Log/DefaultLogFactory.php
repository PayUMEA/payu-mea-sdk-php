<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Log;

use Psr\Log\LoggerInterface;

/**
 * Class DefaultLogFactory
 *
 * This factory is the default implementation of Log factory.
 *
 * @package PayU\Log
 */
class DefaultLogFactory
{
    /**
     * Returns logger instance implementing LoggerInterface.
     *
     * @param string $className
     * @return LoggerInterface instance of logger object implementing LoggerInterface
     */
    public function getLogger(string $className): LoggerInterface
    {
        return new Logger($className);
    }
}
