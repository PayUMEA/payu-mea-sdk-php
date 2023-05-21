<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Validation;

use InvalidArgumentException;

/**
 * Class NumericValidator
 *
 * @package PayU\Framework\Validation
 */
class NumericValidator
{
    /**
     * Helper method for validating an argument if it is numeric
     *
     * @param mixed     $argument
     * @param string|null $argumentName
     * @return bool
     */
    public static function validate(mixed $argument, string $argumentName = null): bool
    {
        if (!is_numeric($argument)) {
            throw new InvalidArgumentException("$argumentName is not a valid numeric value");
        }

        return true;
    }
}
