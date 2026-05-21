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
     * @param mixed $value
     * @param string $formatter
     * @return string
     */
    public static function format(mixed $value, string $formatter): string
    {
        return sprintf($formatter, $value);
    }

    /**
     * Format the input data without decimal places
     *
     * Defaults to no decimal places
     *
     * @param mixed $amount
     * @param int $decimals
     * @return ?int
     */
    public static function formatToInteger(mixed $amount, int $decimals = 2): ?int
    {
        if ($amount === null || (is_string($amount) && trim($amount) === '')) {
            return null;
        }
        return (int)(number_format((float)$amount, $decimals, '.', '') * 100);
    }

    /**
     * Helper method to format price values with associated currency information.
     *
     * It covers the cases where certain currencies does not accept decimal values. We will be adding
     * any specific currency level rules as required here.
     *
     * @param mixed $amount
     * @param string|null $currency
     * @return ?string
     */
    public static function formatToPrice(mixed $amount, $currency = null): ?string
    {
        if ($amount === null || (is_string($amount) && trim($amount) === '')) {
            return null;
        }
        $decimals = 2;
        $currencyDecimals = ['JPY' => 0, 'TWD' => 0];
        $amountStr = (string)$amount;
        $amountFloat = (float)$amount;

        $value = sprintf("%.3f", $amountFloat);

        if ($currency && array_key_exists($currency, $currencyDecimals)) {
            if (str_contains($amountStr, ".") && (floor($amountFloat) != $amountFloat)) {
                //throw exception if it has decimal values for JPY and TWD which does not ends with .00
                throw new InvalidArgumentException("value cannot have decimals for $currency currency");
            }

            $decimals = $currencyDecimals[$currency];
        } elseif (!str_contains($amountStr, ".")) {
            // Check if value has decimal values. If not no need to assign 2 decimals with .00 at the end
            $decimals = 0;
        }

        return self::formatToDecimal($amountFloat, $decimals);
    }

    /**
     * Format the input data with decimal places
     *
     * Defaults to 2 decimal places
     *
     * @param mixed $value
     * @param int $decimals
     * @return null|string
     */
    public static function formatToDecimal(mixed $value, int $decimals = 2): ?string
    {
        if ($value === null || (is_string($value) && trim($value) === '')) {
            return null;
        }
        return number_format((float)$value, $decimals, '.', '');
    }
}
