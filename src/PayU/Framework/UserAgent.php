<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

/**
 * Generates User Agent header for requests
 *
 * @package PayUSdk\Framework
 */
class UserAgent
{
    /**
     * Returns the value of the User-Agent header
     * Add environment values and php version numbers
     *
     * @param string $sdkName
     * @param string $sdkVersion
     * @return string
     */
    public static function getValue($sdkName, $sdkVersion)
    {
        $featureList = [
            'platform-ver=' . PHP_VERSION,
            'bit=' . self::_getPHPBit(),
            'os=' . str_replace(' ', '_', php_uname('s') . ' UserAgent.php' . php_uname('r')),
            'machine=' . php_uname('m')
        ];
        if (extension_loaded('soap')) {
            $soapVersion = SOAP_1_2;
            $featureList[] = 'soap=' . $soapVersion;
        }

        return sprintf("PayU SDK/%s %s (%s)", $sdkName, $sdkVersion, implode('; ', $featureList));
    }

    /**
     * Gets PHP Bit version
     *
     * @return int
     */
    private static function _getPHPBit(): int
    {
        switch (PHP_INT_SIZE) {
            case 4:
                return 32;
            case 8:
                return 64;
            default:
                return PHP_INT_SIZE;
        }
    }
}
