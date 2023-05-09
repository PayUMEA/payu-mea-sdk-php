<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Log;

use Psr\Log\LoggerInterface;

/**
 * Class PayUDefaultLogFactory
 *
 * This factory is the default implementation of Log factory.
 *
 * @package PayU\Log
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class PayUDefaultLogFactory
{
    /**
     * Returns logger instance implementing LoggerInterface.
     *
     * @param string $className
     * @return LoggerInterface instance of logger object implementing LoggerInterface
     */
    public function getLogger(string $className): LoggerInterface
    {
        return new PayULogger($className);
    }
}
