<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Serialize\Serializer;

use InvalidArgumentException;
use PayUSdk\Framework\Serialize\SerializerInterface;

/**
 * Serialize data to JSON, unserialize JSON encoded data
 *
 * @api
 * @since 101.0.0
 */
class Json implements SerializerInterface
{
    /**
     * @inheritDoc
     */
    public function serialize(float|array|bool|int|string|null $data): string
    {
        $result = json_encode($data, 128|64);

        if (false === $result) {
            throw new InvalidArgumentException("Unable to serialize value. Error: " . json_last_error_msg());
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function unserialize(string $string): array|bool|float|int|null|string
    {
        if ($string === null) {
            throw new InvalidArgumentException(
                'Unable to unserialize value. Error: Parameter must be a string type, null given.'
            );
        }

        $result = json_decode($string, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException("Unable to unserialize value. Error: " . json_last_error_msg());
        }

        return $result;
    }
}

