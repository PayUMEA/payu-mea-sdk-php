<?php

namespace PayU\Model;

/**
 * Class UserAgent
 *
 * UserAgent generates User Agent for curl requests
 *
 * @package PayU\Model
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
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
        $featureList = array(
            'platform-ver=' . PHP_VERSION,
            'bit=' . self::_getPHPBit(),
            'os=' . str_replace(' ', '_', php_uname('s') . ' ' . php_uname('r')),
            'machine=' . php_uname('m')
        );
        if (defined('OPENSSL_VERSION_TEXT')) {
            $opensslVersion = explode(' ', OPENSSL_VERSION_TEXT);
            $featureList[] = 'crypto-lib-ver=' . $opensslVersion[1];
        }
        if (function_exists('curl_version')) {
            $curlVersion = curl_version();
            $featureList[] = 'curl=' . $curlVersion['version'];
        }
        return sprintf("PayUSDK/%s %s (%s)", $sdkName, $sdkVersion, implode('; ', $featureList));
    }

    /**
     * Gets PHP Bit version
     *
     * @return int|string
     */
    private static function _getPHPBit()
    {
        switch (PHP_INT_SIZE) {
            case 4:
                return '32';
            case 8:
                return '64';
            default:
                return PHP_INT_SIZE;
        }
    }
}
