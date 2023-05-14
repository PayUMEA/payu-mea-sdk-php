<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface TotalInterface
 *
 * Total of what to pay
 *
 * @package PayU\Api\Data
 */
interface TotalInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Amount.
     */
    const AMOUNT = 'amount';
    /*
     * Currency.
     */
    const CURRENCY = 'currency';

    /**
     * @return string Amount to pay
     */
    public function getAmount(): string;

    /**
     * @return CurrencyInterface The currency to pay in
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): static;

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency): static;
}
