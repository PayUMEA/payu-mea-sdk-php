<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

use InvalidArgumentException;

/**
 * Class Formatter
 *
 * @package PayUSdk\Framework
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
    public static function format($value, $formatter): string
    {
        return sprintf($formatter, $value);
    }

    /**
     * Format the input data without decimal places
     *
     * Defaults to no decimal places
     *
     * @param float $amount
     * @param int $decimals
     * @return int
     */
    public static function formatToInteger(float $amount, int $decimals = 2): int
    {
        return (int)(number_format($amount, $decimals, '.', '') * 100);
    }

    /**
     * Helper method to format price values with associated currency information.
     *
     * It covers the cases where certain currencies does not accept decimal values. We will be adding
     * any specific currency level rules as required here.
     *
     * @param float $amount
     * @param null $currency
     * @return ?string
     */
    public static function formatToPrice(float $amount, $currency = null): ?string
    {
        $decimals = 2;
        $currencyDecimals = ['JPY' => 0, 'TWD' => 0];
        $value = sprintf("%.3f", $amount);

        if ($currency && array_key_exists($currency, $currencyDecimals)) {
            if (str_contains($value, ".") && (floor($amount) != $amount)) {
                //throw exception if it has decimal values for JPY and TWD which does not ends with .00
                throw new InvalidArgumentException("value cannot have decimals for $currency currency");
            }

            $decimals = $currencyDecimals[$currency];
        } elseif (!str_contains($value, ".")) {
            // Check if value has decimal values. If not no need to assign 2 decimals with .00 at the end
            $decimals = 0;
        }

        return self::formatToDecimal($amount, $decimals);
    }

    /**
     * Format the input data with decimal places
     *
     * Defaults to 2 decimal places
     *
     * @param float $value
     * @param int $decimals
     * @return null|string
     */
    public static function formatToDecimal(float $value, int $decimals = 2): ?string
    {
        return number_format($value, $decimals, '.', '');
    }
}
