<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

/**
 * enum Constants
 *
 * PayU Constants
 *
 * @package PayU\Core
 */
enum Constants
{
    public const SDK_NAME = 'PayU-MEA-PHP-SDK';
    public const SDK_VERSION = '0.2.0';
    public const STAGING_REDIRECT_ENDPOINT = 'https://staging.payu.co.za/service/rpp.do';
    public const STAGING_WSDL_ENDPOINT = 'https://staging.payu.co.za/service/PayUAPI?wsdl';
    public const PROD_REDIRECT_ENDPOINT = 'https://secure.payu.co.za/service/rpp.do';
    public const PROD_WSDL_ENDPOINT = 'https://secure.payu.co.za/service/PayUAPI?wsdl';
    public const APPROVAL_URL = 'https://%s.payu.co.za/rpp.do?PayUReference=%s';
}
