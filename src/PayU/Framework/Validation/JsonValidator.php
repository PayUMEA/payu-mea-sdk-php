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

namespace PayU\Framework\Validation;

use InvalidArgumentException;

/**
 * Class JsonValidator
 *
 * @package PayU\Framework\Validation
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
            if ($string === '' || $string === null) {
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
