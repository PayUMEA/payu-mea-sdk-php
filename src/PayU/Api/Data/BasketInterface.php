<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface BasketInterface
 *
 * A basket of items
 *
 * @package PayUSdk\Api\Data
 * @api
 */
interface BasketInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Amount in cents.
     */
    const AMOUNT_IN_CENTS = 'amount_in_cents';
    /*
     * Currency code.
     */
    const CURRENCY_CODE = 'currency_code';
    /*
     * Currency code.
     */
    const DESCRIPTION = 'description';

    /**
     * @return string Basket amount in cents
     */
    public function getAmountInCents(): string;

    /**
     * @return string 3-letter [currency code]
     */
    public function getCurrencyCode(): string;

    /**
     * @return string Basket description
     */
    public function getDescription(): string;

    /**
     * @param int $amountInCents
     * @return $this
     */
    public function setAmountInCents(int $amountInCents): static;

    /**
     * @param string $currencyCode
     * @return $this
     */
    public function setCurrencyCode(string $currencyCode): static;

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): static;
}
