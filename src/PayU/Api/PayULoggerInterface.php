<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

use Psr\Log\LoggerInterface;

/**
 * Interface PayULoggerInterface
 *
 * @package PayU\Api
 */
interface PayULoggerInterface
{
    /**
     * Returns logger instance implementing LoggerInterface.
     *
     * @param string $className
     * @return LoggerInterface instance of logger object implementing LoggerInterface
     */
    public function getLogger(string $className): LoggerInterface;
}
