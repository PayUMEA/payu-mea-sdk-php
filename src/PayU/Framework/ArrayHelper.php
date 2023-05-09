<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Model;

/**
 * Class ArrayHelper
 *
 * Helper Class for Arrays
 *
 * @package PayU\Model
 */
class ArrayHelper
{
    /**
     *
     * @param array $arr
     * @return true if $arr is an associative array
     */
    public static function isAssocArray(array $arr): bool
    {
        foreach ($arr as $k => $v) {
            if (is_int($k)) {
                return false;
            }
        }

        return true;
    }
}
