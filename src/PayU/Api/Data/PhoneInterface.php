<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface PhoneInterface
 *
 * Representing a phone number belonging to a customer
 *
 * @package PayUSdk\Api\Data
 */
interface PhoneInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Country code.
     */
    const COUNTRY_CODE = 'country_code';
    /*
     * Country code.
     */
    const NATIONAL_NUMBER = 'national_number';
    /*
     * Country code.
     */
    const EXTENSION = 'extension';

    /**
     * @return string Phone number country code.
     */
    public function getCountryCode(): string;

    /**
     * @return string Phone number in client's national format.
     */
    public function getNationalNumber(): string;

    /**
     * @return string Phone extension number.
     */
    public function getExtension(): string;

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): static;

    /**
     * @param string $nationalNumber
     * @return $this
     */
    public function setNationalNumber(string $nationalNumber): static;

    /**
     * @param string $extension
     * @return $this
     */
    public function setExtension(string $extension): static;
}
