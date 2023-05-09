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
 * Class UrlValidator
 *
 * @package PayU\Validation
 */
class UrlValidator
{
    /**
     * Helper method for validating URLs that will be used by this API in any requests.
     *
     * @param      $url
     * @param string|null $urlName
     * @throws \InvalidArgumentException
     */
    public static function validate($url, $urlName = null)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException("$urlName is not a fully qualified URL");
        }
    }
}
