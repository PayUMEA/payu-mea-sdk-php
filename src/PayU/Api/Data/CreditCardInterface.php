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
 * A credit card to be used in payment transaction.
 *
 * @package PayUSdk\Api\Data
 */
interface CreditCardInterface extends CardInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Number.
     */
    const NUMBER = 'number';
    /*
     * Cvv.
     */
    const NAME_ON_CARD = 'name_on_card';
    /*
     * Expire month.
     */
    const EXPIRY_MONTH = 'expiry_month';
    /*
     * Expire year.
     */
    const EXPIRY_YEAR = 'expiry_year';
    /*
     * Cvv.
     */
    const CVV = 'cvv';
    /*
     * Budget.
     */
    const BUDGET = 'budget';
    /*
     * Secure 3DS.
     */
    const SECURE3D = 'secure_3d';

    /**
     * @return string
     */
    public function getNumber(): string;

    /**
     * @return string
     */
    public function getNameOnCard(): string;

    /**
     * @return string
     */
    public function getExpiryMonth(): string;

    /**
     * @return string
     */
    public function getExpiryYear(): string;

    /**
     * @return string
     */
    public function getCvv(): string;

    /**
     * @return ?bool
     */
    public function isBudget(): ?bool;

    /**
     * @return ?bool
     */
    public function isSecure3d(): ?bool;

    /**
     * @param string $number
     * @return $this
     */
    public function setNumber(string $number): static;

    /**
     * @param string $nameOnCard
     * @return $this
     */
    public function setNameOnCard(string $nameOnCard): static;

    /**
     * @param string $expiryMonth
     * @return $this
     */
    public function setExpiryMonth(string $expiryMonth): static;

    /**
     * @param string $expiryYear
     * @return $this
     */
    public function setExpiryYear(string $expiryYear): static;

    /**
     * @param string $cvv
     * @return $this
     */
    public function setCvv(string $cvv): static;

    /**
     * @param bool $budget
     * @return $this
     */
    public function setBudget(bool $budget): static;

    /**
     * @param bool $secure3d
     * @return $this
     */
    public function setSecure3d(bool $secure3d): static;
}
