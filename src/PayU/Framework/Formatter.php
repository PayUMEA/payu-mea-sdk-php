<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/16/16
 * Time: 5:19 PM
 */

namespace PayU\Conversion;

/**
 * Class Formatter
 *
 * @package PayU\Exception
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class Formatter
{
    /**
     * Format the data based on the input formatter value
     *
     * @param $value
     * @param $formatter
     * @return string
     */
    public static function format($value, $formatter)
    {
        return sprintf($formatter, $value);
    }

    /**
     * Format the input data without decimal places
     *
     * Defaults to no decimal places
     *
     * @param     $value
     * @param int $decimals
     * @return float|int|string|null
     */
    public static function formatToInteger($value, int $decimals = 2): float|int|string|null
    {
        if (trim($value) != null) {
            return number_format($value, $decimals, '.', '') * 100;
        }

        return null;
    }

    /**
     * Helper method to format price values with associated currency information.
     *
     * It covers the cases where certain currencies does not accept decimal values. We will be adding
     * any specific currency level rules as required here.
     *
     * @param      $value
     * @param null $currency
     * @return null|string
     */
    public static function formatToPrice($value, $currency = null)
    {
        $decimals = 2;
        $currencyDecimals = array('JPY' => 0, 'TWD' => 0);
        if ($currency && array_key_exists($currency, $currencyDecimals)) {
            if (strpos($value, ".") !== false && (floor($value) != $value)) {
                //throw exception if it has decimal values for JPY and TWD which does not ends with .00
                throw new \InvalidArgumentException("value cannot have decimals for $currency currency");
            }
            $decimals = $currencyDecimals[$currency];
        } elseif (strpos($value, ".") === false) {
            // Check if value has decimal values. If not no need to assign 2 decimals with .00 at the end
            $decimals = 0;
        }
        return self::formatToDecimal($value, $decimals);
    }

    /**
     * Format the input data with decimal places
     *
     * Defaults to 2 decimal places
     *
     * @param     $value
     * @param int $decimals
     * @return null|string
     */
    public static function formatToDecimal($value, $decimals = 2)
    {
        if (trim($value) != null) {
            return number_format($value, $decimals, '.', '');
        }
        return null;
    }
}
