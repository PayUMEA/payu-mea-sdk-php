<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface CurrencyInterface
 *
 * Currency in which payments are made
 *
 * @package PayU\Api\Data
 */
interface CurrencyInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Total.
     */
    const CODE = 'code';

    /**
     * @return string Currency code in ISO format
     */
    public function getCode(): string;

    /**
     * @param string $code 3 letter currency code in ISO 4217.
     * @return $this
     */
    public function setCode(string $code): static;
}
