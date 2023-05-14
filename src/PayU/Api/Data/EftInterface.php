<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface EftInterface
 *
 * Manage EFT based payments.
 *
 * @package PayU\Api\Data
 */
interface EftInterface
{
    public const FNB = 'FNB';
    public const ABSA = 'ABSA';
    public const NEDBANK = 'NEDBANK';
    public const STANDARD_BANK = 'STANDARD_BANK';

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Amount to pay.
     */
    const AMOUNT = 'amount';
    /*
     * The type of EFT.
     */
    const TYPE = 'type';
    /*
     * Bank name.
     */
    const BANK_NAME = 'bank_name';

    /**
     * @return string The amount to pay via EFT
     */
    public function getAmount(): string;

    /**
     * @return string The type of EFT payment (EFT Pro or Smart EFT)
     */
    public function getType(): string;

    /**
     * @return string The name of the bank
     */
    public function getBankName(): string;

    /**
     * @return CurrencyInterface The currency
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): static;

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static;

    /**
     * @param string $bankName
     * @return $this
     */
    public function setBankName(string $bankName): static;

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency): static;
}
