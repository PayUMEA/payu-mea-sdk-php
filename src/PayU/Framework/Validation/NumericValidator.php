<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Validation;

use InvalidArgumentException;

/**
 * Class NumericValidator
 *
 * @package PayU\Validation
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
