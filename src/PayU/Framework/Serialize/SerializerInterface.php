<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Serialize;

use InvalidArgumentException;

/**
 * Interface for serializing
 *
 * @api
 * @since 101.0.0
 */
interface SerializerInterface
{
    /**
     * Serialize data into string
     *
     * @param float|array|bool|int|string|null $data
     * @return string|bool
     * @throws InvalidArgumentException
     * @since 101.0.0
     */
    public function serialize(float|array|bool|int|string|null $data): bool|string;

    /**
     * Unserialize the given string
     *
     * @param string $string
     * @return string|int|float|bool|array|null
     * @throws InvalidArgumentException
     * @since 101.0.0
     */
    public function unserialize(string $string): float|array|bool|int|string|null;
}
