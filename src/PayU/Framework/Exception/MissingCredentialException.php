<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Exception;

/**
 * Class MissingCredentialException
 *
 * @package PayUSdk\Framework\Exception
 */
class MissingCredentialException extends \Exception
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

    /**
     * prints error message
     *
     * @return string
     */
    public function errorMessage(): string
    {
        return 'Error in line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b>';
    }
}
