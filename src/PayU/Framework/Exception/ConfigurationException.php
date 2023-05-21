<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Exception;

/**
 * Class ConfigurationException
 *
 * @package PayU\Framework\Exception
 */
class ConfigurationException extends \Exception
{
    /**
     * Default Constructor
     *
     * @param ?string $message
     * @param int $code
     */
    public function __construct(?string $message = null, int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
