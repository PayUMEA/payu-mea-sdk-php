<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Serialize;

use InvalidArgumentException;
use PayU\Framework\Serialize\Serializer\Json;

/**
 * This class was introduced only for usage in the \Magento\Framework\DataObject::toJson method.
 * It should not be used in other cases and instead \Magento\Framework\Serialize\Serializer\Json::serialize
 * should be used.
 */
class JsonConverter
{
    /**
     * This method should only be used by \Magento\Framework\DataObject::toJson
     * All other cases should use \Magento\Framework\Serialize\Serializer\Json::serialize directly
     *
     * @param string|int|float|bool|array|null $data
     * @return bool|string
     * @throws InvalidArgumentException
     */
    public static function convert(string|int|float|bool|array|null $data): bool|string
    {
        $serializer = new Json();

        return $serializer->serialize($data);
    }
}

