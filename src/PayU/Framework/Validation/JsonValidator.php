<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Validation;

use InvalidArgumentException;

/**
 * Class JsonValidator
 *
 * @package PayUSdk\Framework\Validation
 */
class JsonValidator
{
    /**
     * Helper method for validating if string provided is a valid json.
     *
     * @param string $string String representation of Json object
     * @param bool $silent Flag to not throw \InvalidArgumentException
     * @return bool
     */
    public static function validate(string $string, bool $silent = false): bool
    {
        @json_decode($string);

        if (json_last_error() != JSON_ERROR_NONE) {
            if ($string === '') {
                return true;
            }

            if ($silent === false) {
                //Throw an Exception for string or array
                throw new InvalidArgumentException("Invalid JSON String");
            }

            return false;
        }

        return true;
    }
}
