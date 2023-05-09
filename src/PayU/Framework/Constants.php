<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/16/16
 * Time: 12:42 PM
 */

namespace PayU\Core;

/**
 * class Constants
 *
 * Placeholder for PayU Constants
 *
 * @package PayU\Core
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class Constants
{
    const SDK_NAME = 'PayU-MEA-PHP-SDK';
    const SDK_VERSION = '0.2.0';

    const STAGING_REDIRECT_ENDPOINT = 'https://staging.payu.co.za/service/rpp.do';
    const STAGING_WSDL_ENDPOINT = 'https://staging.payu.co.za/service/PayUAPI?wsdl';

    const PROD_REDIRECT_ENDPOINT = 'https://secure.payu.co.za/service/rpp.do';
    const PROD_WSDL_ENDPOINT = 'https://secure.payu.co.za/service/PayUAPI?wsdl';

    const APPROVAL_URL = 'https://%s.payu.co.za/rpp.do?PayUReference=%s';
}
