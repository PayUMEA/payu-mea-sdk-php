<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface CardTokenInterface
 *
 * A token representing a saved card.
 *
 * @package PayUSdk\Api\Data
 */
interface CardTokenInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Token id.
     */
    const ID = 'id';
    /*
     * Last four digits.
     */
    const LAST_FOUR = 'last_four';
    /*
     * Card type.
     */
    const TYPE = 'type';
    /*
     * Last four digits.
     */
    const CVV = 'cvv';

    /**
     * ID of credit card previously stored using `storePaymentMethod` parameter set to `true`.
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Last four digits of the stored credit card number.
     *
     * @return string
     */
    public function getLastFourDigits(): string;

    /**
     * Credit card type. Valid types are: ["VISA", "MASTERCARD"]
     * Values are presented in lowercase and should not be used for display.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @return string
     */
    public function getCvv(): string;

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static;

    /**
     * @param string $lastFour
     * @return $this
     */
    public function setLastFourDigits(string $lastFour): static;

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static;

    /**
     * @param string $cvv
     * @return $this
     */
    public function setCvv(string $cvv): static;
}
