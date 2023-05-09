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

/**
 * Class ArgumentValidator
 *
 * @package PayU\Validation
 */
class ArgumentValidator
{
    /**
     * Helper method for validating an argument that will be used by this API in any requests.
     *
     * @param $argument     mixed The object to be validated
     * @param $argumentName string|null The name of the argument.
     *                      This will be placed in the exception message for easy reference
     * @return bool
     */
    public static function validate($argument, $argumentName = null)
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
