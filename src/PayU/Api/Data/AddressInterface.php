<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface AddressInterface
 *
 * Address used as billing address in a payment or extended for shipping address.
 *
 * @package PayUSdk\Api\Data
 */
interface AddressInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Line 1.
     */
    const LINE1 = 'line1';
    /*
     * Line 2.
     */
    const LINE2 = 'line2';
    /*
     * City.
     */
    const CITY = 'city';
    /*
     * City.
     */
    const PHONE = 'phone';
    /*
     * Country code.
     */
    const COUNTRY_CODE = 'country_code';
    /*
     * Postal code.
     */
    const POSTAL_CODE = 'postal_code';
    /*
     * State.
     */
    const STATE = 'state';

    /**
     * @return string Address line 1.
     */
    public function getLine1(): string;

    /**
     * @return string Address line 2.
     */
    public function getLine2(): string;

    /**
     * @return string Address city.
     */
    public function getCity(): string;

    /**
     * @return PhoneInterface Address phone.
     */
    public function getPhone(): PhoneInterface;

    /**
     * @return string Address country code.
     */
    public function getCountryCode(): string;

    /**
     * @return string Address postal code.
     */
    public function getPostalCode(): string;

    /**
     * @return string Address state.
     */
    public function getState(): string;

    /**
     * @param string $line1
     * @return $this
     */
    public function setLine1(string $line1): static;

    /**
     * @param string $line2
     * @return $this
     */
    public function setLine2(string $line2): static;

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): static;

    /**
     * @param PhoneInterface $phone
     * @return $this
     */
    public function setPhone(PhoneInterface $phone): static;

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): static;

    /**
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode(string $postalCode): static;

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state): static;
}
