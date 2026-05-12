<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Validation;

/**
 * Class ArgumentValidator
 *
 * @package PayUSdk\Framework\Validation
 */
class ArgumentValidator
{
    /**
     * Helper method for validating an argument that will be used by this API in any requests.
     *
     * @param mixed $argument     mixed The object to be validated
     * @param string|null $argumentName string|null The name of the argument.
     *                      This will be placed in the exception message for easy reference
     * @return bool
     */
    public static function validate(mixed $argument, ?string $argumentName = null): bool
    {
        if ($argument === null) {
            // Error if Object Null
            throw new \InvalidArgumentException("$argumentName cannot be null");
        } elseif (gettype($argument) == 'string' && trim($argument) == '') {
            // Error if String Empty
            throw new \InvalidArgumentException("$argumentName string cannot be empty");
        }
        return true;
    }
}
