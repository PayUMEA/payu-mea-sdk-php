<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Validation;

/**
 * Class UrlValidator
 *
 * @package PayUSdk\Framework\Validation
 */
class UrlValidator
{
    /**
     * Helper method for validating URLs that will be used by this API in any requests.
     *
     * @param string $url
     * @param string|null $urlName
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function validate(string $url, ?string $urlName = null): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException("$urlName is not a fully qualified URL");
        }
    }
}
