<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

/**
 * Class ArrayHelper
 *
 * Helper Class for Arrays
 *
 * @package PayUSdk\Framework
 */
class ArrayHelper
{
    /**
     *
     * @param array<int|string, mixed> $arr
     * @return bool
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
